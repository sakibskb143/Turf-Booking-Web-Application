<?php

namespace App\Http\Controllers;

use App\Models\Slot;
use App\Models\Turf;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TurfController extends Controller
{
    public function storeSlot(Request $request, Turf $turf): RedirectResponse
    {
        $owner = $request->user();

        // Ensure owner owns this turf
        if ($turf->owner_id !== $owner->id) {
            abort(403, 'You do not have permission to add slots to this turf.');
        }

        $validated = $request->validate([
            'date' => ['required', 'date', 'after_or_equal:today'],
            'start_time' => ['required', 'date_format:H:i'],
            'end_time' => ['required', 'date_format:H:i', 'after:start_time'],
            'price' => ['required', 'numeric', 'min:0'],
            'status' => ['required', 'in:available,booked'],
        ]);

        Slot::create([
            'turf_id' => $turf->id,
            'date' => $validated['date'],
            'start_time' => $validated['start_time'],
            'end_time' => $validated['end_time'],
            'price' => $validated['price'],
            'status' => $validated['status'],
        ]);

        return redirect()
            ->route('owner.manageSlots')
            ->with('status', 'Slot created successfully.');
    }

    public function updateSlot(Request $request, Slot $slot): RedirectResponse
    {
        $owner = $request->user();

        // Ensure owner owns the turf this slot belongs to
        if ($slot->turf->owner_id !== $owner->id) {
            abort(403, 'You do not have permission to edit this slot.');
        }

        // Check if slot has active bookings
        $hasActiveBookings = $slot->bookings()
            ->where('status', '!=', 'cancelled')
            ->exists();

        if ($hasActiveBookings && $request->input('status') === 'available') {
            return redirect()
                ->route('owner.manageSlots')
                ->with('error', 'Cannot set slot as available when it has active bookings.');
        }

        $validated = $request->validate([
            'date' => ['required', 'date', 'after_or_equal:today'],
            'start_time' => ['required', 'date_format:H:i'],
            'end_time' => ['required', 'date_format:H:i', 'after:start_time'],
            'price' => ['required', 'numeric', 'min:0'],
            'status' => ['required', 'in:available,booked'],
        ]);

        $slot->update($validated);

        return redirect()
            ->route('owner.manageSlots')
            ->with('status', 'Slot updated successfully.');
    }

    public function destroySlot(Request $request, Slot $slot): RedirectResponse
    {
        $owner = $request->user();

        // Ensure owner owns the turf this slot belongs to
        if ($slot->turf->owner_id !== $owner->id) {
            abort(403, 'You do not have permission to delete this slot.');
        }

        // Check if slot has active bookings
        $hasActiveBookings = $slot->bookings()
            ->where('status', '!=', 'cancelled')
            ->exists();

        if ($hasActiveBookings) {
            return redirect()
                ->route('owner.manageSlots')
                ->with('error', 'Cannot delete slot with active bookings. Please cancel bookings first.');
        }

        $slot->delete();

        return redirect()
            ->route('owner.manageSlots')
            ->with('status', 'Slot deleted successfully.');
    }

    public function getSlots(Request $request, Turf $turf): JsonResponse
    {
        $owner = $request->user();

        // Ensure owner owns this turf
        if ($turf->owner_id !== $owner->id) {
            abort(403, 'You do not have permission to view slots for this turf.');
        }

        $date = $request->input('date', now()->toDateString());

        $slots = $turf->slots()
            ->whereDate('date', $date)
            ->with('bookings')
            ->orderBy('start_time')
            ->get();

        return response()->json([
            'slots' => $slots,
        ]);
    }
}
