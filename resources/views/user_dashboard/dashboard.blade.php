@extends('layouts.user_dashboard_layout')

@section('content')
<h2 class="fw-bold mb-4">Dashboard</h2>

<div class="row">
    <div class="col-md-3">
        <div class="p-3 bg-white shadow-sm rounded">
            <h6>Total Bookings</h6>
            <h3 class="fw-bold">{{ $totalBookings }}</h3>
        </div>
    </div>

    <div class="col-md-3">
        <div class="p-3 bg-white shadow-sm rounded">
            <h6>This Month</h6>
            <h3 class="fw-bold">{{ $thisMonthBookings }}</h3>
        </div>
    </div>

    <div class="col-md-3">
        <div class="p-3 bg-white shadow-sm rounded">
            <h6>Amount Spent</h6>
            <h3 class="fw-bold">₹{{ number_format($amountSpent, 2) }}</h3>
        </div>
    </div>

    <div class="col-md-3">
        <div class="p-3 bg-white shadow-sm rounded">
            <h6>Last Login</h6>
            <h3 class="fw-bold">{{ optional($user->updated_at)->format('d M') }}</h3>
        </div>
    </div>
</div>

<!-- ---------------------------- -->
<!-- 🆕 Recent Bookings + Notifications Section -->
<!-- ---------------------------- -->

<div class="row mt-4">

    <!-- Recent Bookings -->
    <div class="col-md-8">
        <div class="bg-white p-3 shadow-sm rounded">
            <h5 class="fw-bold mb-3">Recent Bookings</h5>
            <p class="text-muted small">Your latest turf bookings and their status</p>

            @forelse ($recentBookings as $booking)
                @php
                    $slot = $booking->slot;
                    $slotDate = optional($slot)->date;
                    $startTime = optional($slot)->start_time;
                    $endTime = optional($slot)->end_time;
                    $startTimeFormatted = $startTime ? (is_string($startTime) ? $startTime : date('H:i', strtotime($startTime))) : '-';
                    $endTimeFormatted = $endTime ? (is_string($endTime) ? $endTime : date('H:i', strtotime($endTime))) : '-';
                @endphp
                <div class="border rounded p-3 mb-3 d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="fw-bold mb-1">{{ $booking->turf->name }}</h6>
                        <p class="mb-0 text-muted small">
                            <i class="bi bi-calendar"></i> {{ optional($slotDate)->toDateString() ?? '-' }} &nbsp;&nbsp;
                            <i class="bi bi-clock"></i> {{ $startTimeFormatted }} - {{ $endTimeFormatted }} &nbsp;&nbsp;
                            ₹{{ number_format($booking->total_amount, 2) }}
                        </p>
                    </div>
                    <div>
                        <span class="badge bg-{{ $booking->status === 'confirmed' ? 'success' : ($booking->status === 'pending' ? 'warning text-dark' : 'danger') }}">
                            {{ ucfirst($booking->status) }}
                        </span>
                    </div>
                </div>
            @empty
                <p class="text-muted">No bookings yet. Book your first turf!</p>
            @endforelse

            <div class="text-center mt-3">
                <a href="{{ route('user.bookings') }}" class="btn btn-outline-dark">View All Bookings</a>
            </div>
        </div>
    </div>

    <!-- Notifications -->
    <div class="col-md-4">
        <div class="bg-white p-3 shadow-sm rounded">
            <h5 class="fw-bold mb-3">Notifications</h5>
            <p class="text-muted small">Recent updates and reminders</p>

            @forelse ($notifications as $notification)
                <div class="border rounded p-3 mb-3">
                    <p class="mb-1">{{ $notification->message }}</p>
                    <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                </div>
            @empty
                <p class="text-muted">No notifications yet.</p>
            @endforelse

                <div class="text-center mt-3">
                    <a href="{{ route('user.notifications') }}" class="btn btn-outline-dark">View All Notifications</a>
                </div>
        </div>
    </div>
</div>

@endsection
