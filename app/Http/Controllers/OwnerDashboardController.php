<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Slot;
use App\Models\Turf;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class OwnerDashboardController extends Controller
{
    public function dashboard(Request $request)
    {
        $owner = $request->user();
        
        // Get owner's turfs
        $turfs = $owner->turfs()->withCount('bookings')->get();
        
        // Get all bookings for owner's turfs
        $allBookings = Booking::whereIn('turf_id', $turfs->pluck('id'))
            ->with(['user', 'turf', 'slot'])
            ->latest()
            ->get();
        
        // Calculate stats
        $todayRevenue = $allBookings
            ->where('status', 'confirmed')
            ->filter(function ($booking) {
                return $booking->created_at->isToday();
            })
            ->sum('total_amount');
        
        $thisWeekRevenue = $allBookings
            ->where('status', 'confirmed')
            ->filter(function ($booking) {
                return $booking->created_at->isCurrentWeek();
            })
            ->sum('total_amount');
        
        $thisMonthRevenue = $allBookings
            ->where('status', 'confirmed')
            ->filter(function ($booking) {
                return $booking->created_at->isCurrentMonth();
            })
            ->sum('total_amount');
        
        $totalBookings = $allBookings->count();
        $confirmedBookings = $allBookings->where('status', 'confirmed')->count();
        $pendingBookings = $allBookings->where('status', 'pending')->count();
        
        // Recent bookings
        $recentBookings = $allBookings->take(10);
        
        return view('owner_dashboard.dashboard', [
            'owner' => $owner,
            'turfs' => $turfs,
            'todayRevenue' => $todayRevenue,
            'thisWeekRevenue' => $thisWeekRevenue,
            'thisMonthRevenue' => $thisMonthRevenue,
            'totalBookings' => $totalBookings,
            'confirmedBookings' => $confirmedBookings,
            'pendingBookings' => $pendingBookings,
            'recentBookings' => $recentBookings,
        ]);
    }

    public function manageTurf(Request $request)
    {
        $owner = $request->user();
        $turfs = $owner->turfs()->withCount('bookings')->latest()->get();
        
        return view('owner_dashboard.turf_management', [
            'turfs' => $turfs,
        ]);
    }

    public function storeTurf(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'sport_type' => ['required', 'string', 'max:255'],
            'location' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'base_price' => ['required', 'numeric', 'min:0'],
            'image_url' => ['nullable', 'url', 'max:500'],
            'status' => ['required', 'in:active,inactive'],
        ]);

        $owner = $request->user();

        if ($owner->role !== 'owner') {
            abort(403, 'Only owners can create turfs.');
        }

        Turf::create([
            'owner_id' => $owner->id,
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
            'sport_type' => $validated['sport_type'],
            'location' => $validated['location'],
            'city' => $validated['city'],
            'description' => $validated['description'] ?? null,
            'base_price' => $validated['base_price'],
            'image_url' => $validated['image_url'] ?? null,
            'status' => $validated['status'],
        ]);

        return redirect()
            ->route('owner.manageTurf')
            ->with('status', 'Turf created successfully.');
    }

    public function updateTurf(Request $request, Turf $turf): RedirectResponse
    {
        $owner = $request->user();

        // Ensure owner owns this turf
        if ($turf->owner_id !== $owner->id) {
            abort(403, 'You do not have permission to edit this turf.');
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'sport_type' => ['required', 'string', 'max:255'],
            'location' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'base_price' => ['required', 'numeric', 'min:0'],
            'image_url' => ['nullable', 'url', 'max:500'],
            'status' => ['required', 'in:active,inactive'],
        ]);

        $turf->update([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
            'sport_type' => $validated['sport_type'],
            'location' => $validated['location'],
            'city' => $validated['city'],
            'description' => $validated['description'] ?? null,
            'base_price' => $validated['base_price'],
            'image_url' => $validated['image_url'] ?? null,
            'status' => $validated['status'],
        ]);

        return redirect()
            ->route('owner.manageTurf')
            ->with('status', 'Turf updated successfully.');
    }

    public function destroyTurf(Request $request, Turf $turf): RedirectResponse
    {
        $owner = $request->user();

        // Ensure owner owns this turf
        if ($turf->owner_id !== $owner->id) {
            abort(403, 'You do not have permission to delete this turf.');
        }

        // Check if turf has active bookings
        $activeBookings = $turf->bookings()
            ->where('status', '!=', 'cancelled')
            ->exists();

        if ($activeBookings) {
            return redirect()
                ->route('owner.manageTurf')
                ->with('error', 'Cannot delete turf with active bookings. Please cancel all bookings first.');
        }

        DB::transaction(function () use ($turf) {
            // Delete slots
            $turf->slots()->delete();
            // Delete bookings
            $turf->bookings()->delete();
            // Delete turf
            $turf->delete();
        });

        return redirect()
            ->route('owner.manageTurf')
            ->with('status', 'Turf deleted successfully.');
    }

    public function bookings(Request $request)
    {
        $owner = $request->user();
        
        // Get all bookings for owner's turfs
        $turfIds = $owner->turfs()->pluck('id');
        
        $bookings = Booking::whereIn('turf_id', $turfIds)
            ->with(['user', 'turf', 'slot'])
            ->latest()
            ->paginate(15);
        
        $stats = [
            'total' => Booking::whereIn('turf_id', $turfIds)->count(),
            'confirmed' => Booking::whereIn('turf_id', $turfIds)->where('status', 'confirmed')->count(),
            'pending' => Booking::whereIn('turf_id', $turfIds)->where('status', 'pending')->count(),
            'cancelled' => Booking::whereIn('turf_id', $turfIds)->where('status', 'cancelled')->count(),
        ];
        
        return view('owner_dashboard.bookings', [
            'bookings' => $bookings,
            'stats' => $stats,
        ]);
    }

    public function updateBookingStatus(Request $request, Booking $booking): RedirectResponse
    {
        $owner = $request->user();
        
        // Ensure booking belongs to owner's turf
        if ($booking->turf->owner_id !== $owner->id) {
            abort(403, 'You do not have permission to update this booking.');
        }
        
        $validated = $request->validate([
            'status' => ['required', 'in:confirmed,pending,cancelled'],
        ]);
        
        $oldStatus = $booking->status;
        $booking->update(['status' => $validated['status']]);
        
        // If cancelled, update slot status
        if ($validated['status'] === 'cancelled' && $oldStatus !== 'cancelled') {
            $booking->slot->update(['status' => 'available']);
        }
        
        // If confirmed from pending, update slot status
        if ($validated['status'] === 'confirmed' && $oldStatus === 'pending') {
            $booking->slot->update(['status' => 'booked']);
        }
        
        return redirect()
            ->route('owner.bookings')
            ->with('status', 'Booking status updated successfully.');
    }

    public function manageSlots(Request $request)
    {
        $owner = $request->user();
        $turfs = $owner->turfs()->get();
        
        // Get all slots for owner's turfs
        $turfIds = $turfs->pluck('id');
        $slots = Slot::whereIn('turf_id', $turfIds)
            ->with('turf')
            ->latest()
            ->paginate(15);
        
        // Calculate stats
        $totalSlots = Slot::whereIn('turf_id', $turfIds)->count();
        $availableSlots = Slot::whereIn('turf_id', $turfIds)
            ->where('status', 'available')
            ->count();
        $bookedSlots = Slot::whereIn('turf_id', $turfIds)
            ->where('status', 'booked')
            ->count();
        
        // Revenue today
        $todayRevenue = Booking::whereIn('turf_id', $turfIds)
            ->where('status', 'confirmed')
            ->whereDate('created_at', today())
            ->sum('total_amount');
        
        return view('owner_dashboard.manage_slots', [
            'turfs' => $turfs,
            'slots' => $slots,
            'totalSlots' => $totalSlots,
            'availableSlots' => $availableSlots,
            'bookedSlots' => $bookedSlots,
            'todayRevenue' => $todayRevenue,
        ]);
    }

    public function notifications(Request $request)
    {
        $owner = $request->user();
        $notifications = $owner->userNotifications()->latest()->paginate(10);
        
        return view('owner_dashboard.owner_notifications', [
            'notifications' => $notifications,
        ]);
    }
}
