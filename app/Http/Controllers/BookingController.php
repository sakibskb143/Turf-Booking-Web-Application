<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Slot;
use App\Models\Turf;
use App\Models\UserNotification;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $selectedDate = $request->input('date', now()->toDateString());
        $sport = $request->input('sport');
        $search = $request->input('search');
        $city = $request->input('city');

        $turfsQuery = Turf::query()
            ->with('owner')
            ->with(['slots' => function ($query) use ($selectedDate) {
                $query->whereDate('date', $selectedDate)
                    ->with(['bookings' => function ($q) {
                        $q->where('status', '!=', 'cancelled');
                    }])
                    ->orderBy('start_time');
            }])
            ->where('status', 'active');

        if ($sport) {
            $turfsQuery->where('sport_type', $sport);
        }

        if ($city) {
            $turfsQuery->where('city', $city);
        }

        if ($search) {
            $turfsQuery->where(function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('location', 'like', "%{$search}%");
            });
        }

        $turfs = $turfsQuery->orderBy('name')->get();

        $sportFilters = Turf::query()->select('sport_type')->distinct()->pluck('sport_type')->filter();
        $cityFilters = Turf::query()->select('city')->distinct()->pluck('city')->filter();

        return view('pages.bookturf', [
            'turfs' => $turfs,
            'selectedDate' => $selectedDate,
            'sportFilters' => $sportFilters,
            'cityFilters' => $cityFilters,
        ]);
    }

    public function slots(Request $request, Turf $turf): JsonResponse
    {
        $selectedDate = $request->input('date', now()->toDateString());

        $slots = $turf->slots()
            ->whereDate('date', $selectedDate)
            ->orderBy('start_time')
            ->get()
            ->map(function (Slot $slot) {
                $isBooked = $slot->bookings()
                    ->where('status', '!=', 'cancelled')
                    ->exists();
                
                return [
                    'id' => $slot->id,
                    'date' => $slot->date->toDateString(),
                    'start_time' => is_string($slot->start_time) ? $slot->start_time : date('H:i', strtotime($slot->start_time)),
                    'end_time' => is_string($slot->end_time) ? $slot->end_time : date('H:i', strtotime($slot->end_time)),
                    'price' => $slot->price,
                    'status' => $isBooked ? 'booked' : $slot->status,
                ];
            });

        return response()->json([
            'turf' => $turf->only(['id', 'name']),
            'slots' => $slots,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'slot_id' => ['required', 'exists:slots,id'],
        ]);

        $user = $request->user();

        if ($user->role !== 'user') {
            abort(403, 'Only customers can create bookings.');
        }
        $slotId = (int) $validated['slot_id'];

        DB::transaction(function () use ($slotId, $user) {
            $slot = Slot::lockForUpdate()->with('turf')->findOrFail($slotId);

            // Check if slot is already booked by checking existing bookings
            $existingBooking = Booking::where('slot_id', $slot->id)
                ->where('status', '!=', 'cancelled')
                ->exists();

            if ($existingBooking || $slot->status === 'booked') {
                throw ValidationException::withMessages([
                    'slot_id' => 'This slot has already been booked. Please pick another slot.',
                ]);
            }

            // Check if user already has a booking for this slot
            $userBooking = Booking::where('slot_id', $slot->id)
                ->where('user_id', $user->id)
                ->where('status', '!=', 'cancelled')
                ->exists();

            if ($userBooking) {
                throw ValidationException::withMessages([
                    'slot_id' => 'You have already booked this slot.',
                ]);
            }

            Booking::create([
                'user_id' => $user->id,
                'turf_id' => $slot->turf_id,
                'slot_id' => $slot->id,
                'total_amount' => $slot->price,
                'status' => 'confirmed',
                'payment_status' => 'unpaid',
            ]);

            $slot->update(['status' => 'booked']);

            UserNotification::create([
                'user_id' => $user->id,
                'message' => sprintf(
                    'Booking confirmed for %s on %s (%s - %s).',
                    $slot->turf->name,
                    $slot->date->toFormattedDateString(),
                    is_string($slot->start_time) ? $slot->start_time : date('H:i', strtotime($slot->start_time)),
                    is_string($slot->end_time) ? $slot->end_time : date('H:i', strtotime($slot->end_time))
                ),
                'type' => 'booking',
                'status' => 'unread',
            ]);

            UserNotification::create([
                'user_id' => $slot->turf->owner_id,
                'message' => sprintf(
                    '%s booked %s on %s (%s - %s).',
                    $user->name,
                    $slot->turf->name,
                    $slot->date->toFormattedDateString(),
                    is_string($slot->start_time) ? $slot->start_time : date('H:i', strtotime($slot->start_time)),
                    is_string($slot->end_time) ? $slot->end_time : date('H:i', strtotime($slot->end_time))
                ),
                'type' => 'booking',
                'status' => 'unread',
            ]);
        });

        return redirect()
            ->route('user.bookings')
            ->with('status', 'Your booking has been created successfully.');
    }
}

