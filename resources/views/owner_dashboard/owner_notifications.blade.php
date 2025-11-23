@extends('layouts.owner_dashboard_layout')

@section('content')
<div class="container-fluid">

    <h3 class="fw-bold mb-4">Notifications</h3>

    <!-- Top Summary Cards -->
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card p-3 shadow-sm text-center">
                <h5 class="mb-1">{{ $unread ?? 3 }}</h5>
                <p class="text-muted mb-0">Unread</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3 shadow-sm text-center">
                <h5 class="mb-1 text-danger">{{ $highPriority ?? 3 }}</h5>
                <p class="text-muted mb-0">High Priority</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3 shadow-sm text-center">
                <h5 class="mb-1">{{ $total ?? 8 }}</h5>
                <p class="text-muted mb-0">Total</p>
            </div>
        </div>
    </div>

    <!-- Buttons -->
    <div class="d-flex gap-2 mb-4">
        <button class="btn btn-success">Mark All as Read</button>
        <button class="btn btn-outline-secondary">Clear Read Notifications</button>
        <button class="btn btn-outline-primary">Notification Settings</button>
    </div>

    <!-- Notifications List -->
    <div class="card shadow-sm p-3">
        <h5 class="mb-3">All Notifications</h5>

        {{-- Loop through dynamic notifications --}}
        @foreach ($notifications ?? [] as $note)
            <div class="p-3 border rounded mb-3 d-flex justify-content-between align-items-start"
                 style="background: {{ $note->is_read ? '#fff' : '#f1f5f9' }}">

                <div>
                    <h6 class="fw-semibold mb-1">
                        <i class="bi bi-{{ $note->icon }} me-2"></i>
                        {{ $note->title }}
                    </h6>

                    <p class="text-muted mb-1" style="font-size: 14px;">
                        {{ $note->message }}
                    </p>

                    <span class="badge 
                        @if($note->status=='approved') bg-success 
                        @elseif($note->status=='pending') bg-warning text-dark
                        @elseif($note->status=='cancelled') bg-danger
                        @else bg-secondary 
                        @endif">
                        {{ ucfirst($note->status) }}
                    </span>
                </div>

                <div>
                    @if($note->action)
                        <a href="{{ $note->action_url }}" class="btn btn-success btn-sm me-2">
                            {{ $note->action }}
                        </a>
                    @endif

                    <a href="{{ $note->details_url }}" class="btn btn-outline-primary btn-sm">View Details</a>
                </div>
            </div>
        @endforeach

        {{-- Static sample cards based on your screenshot --}}
        @include('owner_dashboard.partials.sample_notifications')

        <div class="text-center mt-4">
            <button class="btn btn-outline-secondary">Load More Notifications</button>
        </div>
    </div>

</div>
@endsection
