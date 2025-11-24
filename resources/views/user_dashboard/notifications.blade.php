@extends('layouts.user_dashboard_layout')

@section('content')
<h2 class="fw-bold mb-3">Notifications</h2>
<p class="text-muted mb-4">Stay up to date with booking updates.</p>

<div class="card shadow-sm">
    <div class="card-body">
        @forelse ($notifications as $notification)
            <div class="border rounded p-3 mb-3 {{ $notification->status === 'unread' ? 'bg-light' : '' }}">
                <div class="d-flex justify-content-between align-items-start">
                    <p class="mb-1 fw-semibold">{{ $notification->message }}</p>
                    <span class="badge bg-{{ $notification->status === 'unread' ? 'warning text-dark' : 'secondary' }}">
                        {{ ucfirst($notification->status) }}
                    </span>
                </div>
                <small class="text-muted">{{ $notification->created_at->format('d M Y, H:i') }}</small>
            </div>
        @empty
            <p class="text-muted mb-0">No notifications yet.</p>
        @endforelse

        <div class="mt-3">
            {{ $notifications->links() }}
        </div>
    </div>
</div>
@endsection

