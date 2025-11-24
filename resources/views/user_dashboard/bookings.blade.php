@extends('layouts.user_dashboard_layout')

@section('content')

<h2 class="fw-bold mb-1">Booking History</h2>
<p class="text-muted mb-4">View and manage all your past turf bookings.</p>

@if (session('status'))
    <div class="alert alert-success">{{ session('status') }}</div>
@endif

<!-- Stats -->
<div class="row mb-4">
    <div class="col-md-4">
        <div class="shadow-sm p-3 border rounded text-center bg-white">
            <h3 class="fw-bold mb-0">{{ $totalBookings }}</h3>
            <p class="text-muted mb-0">Total Bookings</p>
        </div>
    </div>

    <div class="col-md-4">
        <div class="shadow-sm p-3 border rounded text-center bg-white">
            <h3 class="fw-bold mb-0">{{ $completedBookings }}</h3>
            <p class="text-muted mb-0">Completed</p>
        </div>
    </div>

    <div class="col-md-4">
        <div class="shadow-sm p-3 border rounded text-center bg-white">
            <h3 class="fw-bold mb-0">₹{{ number_format($totalSpent, 2) }}</h3>
            <p class="text-muted mb-0">Total Spent</p>
        </div>
    </div>
</div>

<!-- Filter -->
<div class="card p-3 shadow-sm mb-4">
    <div class="row g-2">
        <div class="col-md-10">
            <input type="text" class="form-control" placeholder="Search by field name or booking ID...">
        </div>
        <div class="col-md-2 d-flex gap-2">
            <button class="btn btn-dark w-50">Filter</button>
            <button class="btn btn-outline-secondary w-50">Export</button>
        </div>
    </div>
</div>

<!-- Booking Table -->
<div class="card p-3 shadow-sm">

    <h5 class="fw-bold mb-3">All Bookings</h5>

    <table class="table table-bordered align-middle">
        <thead class="bg-light">
            <tr>
                <th>Booking ID</th>
                <th>Date</th>
                <th>Field</th>
                <th>Time</th>
                <th>Status</th>
                <th>Payment</th>
                <th>Amount</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($bookings as $booking)
                @php
                    $slot = $booking->slot;
                    $slotDate = optional($slot)->date;
                    $startTime = optional($slot)->start_time;
                    $endTime = optional($slot)->end_time;
                    $startTimeFormatted = $startTime ? (is_string($startTime) ? $startTime : date('H:i', strtotime($startTime))) : '-';
                    $endTimeFormatted = $endTime ? (is_string($endTime) ? $endTime : date('H:i', strtotime($endTime))) : '-';
                @endphp
                <tr>
                    <td>#BK{{ str_pad($booking->id, 4, '0', STR_PAD_LEFT) }}</td>
                    <td>{{ optional($slotDate)->toDateString() ?? '-' }}</td>
                    <td>{{ $booking->turf->name }}</td>
                    <td>{{ $startTimeFormatted }} - {{ $endTimeFormatted }}</td>
                    <td>
                        <span class="badge bg-{{ $booking->status === 'confirmed' ? 'success' : ($booking->status === 'pending' ? 'warning text-dark' : 'danger') }}">
                            {{ ucfirst($booking->status) }}
                        </span>
                    </td>
                    <td>
                        <span class="badge bg-{{ $booking->payment_status === 'paid' ? 'primary' : ($booking->payment_status === 'refunded' ? 'info text-dark' : 'secondary') }}">
                            {{ ucfirst($booking->payment_status) }}
                        </span>
                    </td>
                    <td>₹{{ number_format($booking->total_amount, 2) }}</td>
                    <td><span class="text-muted small">{{ $booking->created_at->diffForHumans() }}</span></td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center text-muted py-4">No bookings found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-3">
        {{ $bookings->links() }}
    </div>
</div>

@endsection
