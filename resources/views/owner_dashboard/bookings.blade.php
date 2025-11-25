@extends('layouts.owner_dashboard_layout')

@section('content')
<div class="container-fluid">
    <h3 class="fw-bold mb-3">Booking Management</h3>
    <p class="text-muted">Review and manage all booking requests for your turfs.</p>

    @if(session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Top Stats --}}
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card card-stats p-3 shadow-sm">
                <p class="text-muted mb-1">Total Bookings</p>
                <h4 class="fw-bold">{{ $stats['total'] ?? 0 }}</h4>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-stats p-3 shadow-sm">
                <p class="text-muted mb-1">Pending Approval</p>
                <h4 class="fw-bold text-warning">{{ $stats['pending'] ?? 0 }}</h4>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-stats p-3 shadow-sm">
                <p class="text-muted mb-1">Confirmed</p>
                <h4 class="fw-bold text-success">{{ $stats['confirmed'] ?? 0 }}</h4>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-stats p-3 shadow-sm">
                <p class="text-muted mb-1">Cancelled</p>
                <h4 class="fw-bold text-danger">{{ $stats['cancelled'] ?? 0 }}</h4>
            </div>
        </div>
    </div>

    {{-- Bookings Table --}}
    <div class="card shadow-sm p-3">
        <h6 class="fw-bold mb-3">All Bookings ({{ $bookings->total() }})</h6>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Booking ID</th>
                        <th>Customer</th>
                        <th>Turf</th>
                        <th>Date & Time</th>
                        <th>Status</th>
                        <th>Amount</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bookings ?? [] as $booking)
                        <tr>
                            <td>#BK{{ str_pad($booking->id, 4, '0', STR_PAD_LEFT) }}</td>
                            <td>
                                <strong>{{ $booking->user->name }}</strong><br>
                                <small class="text-muted">{{ $booking->user->email }}</small>
                            </td>
                            <td>
                                <strong>{{ $booking->turf->name }}</strong><br>
                                <small class="text-muted">{{ $booking->turf->sport_type }}</small>
                            </td>
                            <td>
                                {{ $booking->slot->date->format('Y-m-d') }}<br>
                                <small class="text-muted">
                                    {{ is_string($booking->slot->start_time) ? $booking->slot->start_time : date('H:i', strtotime($booking->slot->start_time)) }} - 
                                    {{ is_string($booking->slot->end_time) ? $booking->slot->end_time : date('H:i', strtotime($booking->slot->end_time)) }}
                                </small>
                            </td>
                            <td>
                                <span class="badge bg-{{ $booking->status === 'confirmed' ? 'success' : ($booking->status === 'pending' ? 'warning text-dark' : 'danger') }}">
                                    {{ ucfirst($booking->status) }}
                                </span>
                            </td>
                            <td>₹{{ number_format($booking->total_amount, 2) }}</td>
                            <td class="text-center">
                                @if($booking->status === 'pending')
                                    <form method="POST" action="{{ route('owner.bookings.updateStatus', $booking) }}" class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="confirmed">
                                        <button type="submit" class="btn btn-success btn-sm" title="Approve">
                                            <i class="bi bi-check"></i>
                                        </button>
                                    </form>
                                    <form method="POST" action="{{ route('owner.bookings.updateStatus', $booking) }}" class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="cancelled">
                                        <button type="submit" class="btn btn-danger btn-sm" title="Reject">
                                            <i class="bi bi-x"></i>
                                        </button>
                                    </form>
                                @else
                                    <form method="POST" action="{{ route('owner.bookings.updateStatus', $booking) }}" class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="{{ $booking->status === 'confirmed' ? 'cancelled' : 'confirmed' }}">
                                        <button type="submit" class="btn btn-outline-{{ $booking->status === 'confirmed' ? 'danger' : 'success' }} btn-sm" title="{{ $booking->status === 'confirmed' ? 'Cancel' : 'Confirm' }}">
                                            <i class="bi bi-{{ $booking->status === 'confirmed' ? 'x' : 'check' }}"></i>
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">
                                <i class="bi bi-inbox" style="font-size: 3rem;"></i>
                                <p class="mt-2">No bookings yet.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($bookings->hasPages())
            <div class="mt-3">
                {{ $bookings->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
