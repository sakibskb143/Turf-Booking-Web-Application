@extends('layouts.owner_dashboard_layout')

@section('content')
<div class="container-fluid">
    <h3 class="fw-bold mb-4">Notifications</h3>

    @if(session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Top Summary Cards -->
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card p-3 shadow-sm text-center">
                <h5 class="mb-1">{{ $notifications->where('status', 'unread')->count() }}</h5>
                <p class="text-muted mb-0">Unread</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3 shadow-sm text-center">
                <h5 class="mb-1 text-primary">{{ $notifications->where('type', 'booking')->count() }}</h5>
                <p class="text-muted mb-0">Booking Notifications</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3 shadow-sm text-center">
                <h5 class="mb-1">{{ $notifications->total() }}</h5>
                <p class="text-muted mb-0">Total</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3 shadow-sm text-center">
                <h5 class="mb-1 text-success">{{ $notifications->where('status', 'read')->count() }}</h5>
                <p class="text-muted mb-0">Read</p>
            </div>
        </div>
    </div>

    <!-- Notifications List -->
    <div class="card shadow-sm p-3">
        <h5 class="mb-3">All Notifications</h5>

        @forelse($notifications ?? [] as $notification)
            <div class="p-3 border rounded mb-3 d-flex justify-content-between align-items-start {{ $notification->status === 'unread' ? 'bg-light' : '' }}">
                <div class="flex-grow-1">
                    <div class="d-flex align-items-center mb-2">
                        <i class="bi bi-{{ $notification->type === 'booking' ? 'calendar-check' : 'bell' }} me-2 text-primary"></i>
                        <h6 class="fw-semibold mb-0">{{ ucfirst($notification->type) }} Notification</h6>
                        @if($notification->status === 'unread')
                            <span class="badge bg-warning text-dark ms-2">Unread</span>
                        @endif
                    </div>
                    <p class="text-muted mb-2">{{ $notification->message }}</p>
                    <small class="text-muted">
                        <i class="bi bi-clock me-1"></i>
                        {{ $notification->created_at->diffForHumans() }} ({{ $notification->created_at->format('d M Y, H:i') }})
                    </small>
                </div>
                <div class="ms-3">
                    @if($notification->type === 'booking')
                        <a href="{{ route('owner.bookings') }}" class="btn btn-outline-primary btn-sm">View Bookings</a>
                    @endif
                </div>
            </div>
        @empty
            <div class="text-center py-5">
                <i class="bi bi-inbox text-muted" style="font-size: 3rem;"></i>
                <p class="text-muted mt-3">No notifications yet.</p>
            </div>
        @endforelse

        {{-- Pagination --}}
        @if($notifications->hasPages())
            <div class="mt-3">
                {{ $notifications->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
