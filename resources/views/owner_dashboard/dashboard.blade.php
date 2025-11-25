@extends('layouts.owner_dashboard_layout')

@section('content')
<div class="container-fluid">
    <h3 class="fw-bold mb-4">Owner Dashboard</h3>

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
                <p class="mb-1 text-muted">Today's Revenue</p>
                <h5 class="fw-bold">₹{{ number_format($todayRevenue ?? 0, 2) }}</h5>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-stats p-3 shadow-sm">
                <p class="mb-1 text-muted">This Week</p>
                <h5 class="fw-bold">₹{{ number_format($thisWeekRevenue ?? 0, 2) }}</h5>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-stats p-3 shadow-sm">
                <p class="mb-1 text-muted">This Month</p>
                <h5 class="fw-bold">₹{{ number_format($thisMonthRevenue ?? 0, 2) }}</h5>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-stats p-3 shadow-sm">
                <p class="mb-1 text-muted">Total Bookings</p>
                <h5 class="fw-bold">{{ $totalBookings ?? 0 }}</h5>
            </div>
        </div>
    </div>

    {{-- Latest Bookings --}}
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card p-3 shadow-sm">
                <h5 class="fw-bold mb-3">Latest Bookings</h5>
                <div class="list-group">
                    @forelse($recentBookings ?? [] as $booking)
                        <div class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <strong>{{ $booking->user->name }}</strong>
                                <span class="status-badge status-{{ $booking->status === 'confirmed' ? 'confirmed' : ($booking->status === 'pending' ? 'pending' : 'secondary') }} ms-2">
                                    {{ ucfirst($booking->status) }}
                                </span>
                                <div class="text-muted">
                                    {{ $booking->turf->name }} | 
                                    {{ $booking->slot->date->format('Y-m-d') }} | 
                                    {{ is_string($booking->slot->start_time) ? $booking->slot->start_time : date('H:i', strtotime($booking->slot->start_time)) }} - 
                                    {{ is_string($booking->slot->end_time) ? $booking->slot->end_time : date('H:i', strtotime($booking->slot->end_time)) }} | 
                                    ₹{{ number_format($booking->total_amount, 2) }}
                                </div>
                            </div>
                            @if($booking->status === 'pending')
                                <div>
                                    <form method="POST" action="{{ route('owner.bookings.updateStatus', $booking) }}" class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="confirmed">
                                        <button type="submit" class="btn btn-sm btn-success me-1">Approve</button>
                                    </form>
                                    <form method="POST" action="{{ route('owner.bookings.updateStatus', $booking) }}" class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="cancelled">
                                        <button type="submit" class="btn btn-sm btn-danger">Reject</button>
                                    </form>
                                </div>
                            @else
                                <a href="{{ route('owner.bookings') }}" class="btn btn-sm btn-outline-primary">View Details</a>
                            @endif
                        </div>
                    @empty
                        <div class="list-group-item text-muted text-center">
                            No bookings yet.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- Quick Actions --}}
        <div class="col-lg-4">
            <div class="card p-3 shadow-sm mb-4">
                <h5 class="fw-bold mb-3">Quick Actions</h5>
                <button class="btn btn-success w-100 mb-2" data-bs-toggle="modal" data-bs-target="#addTurfModal">Add New Turf</button>
                <a href="{{ route('owner.manageTurf') }}" class="btn btn-outline-primary w-100 mb-2">
                    Manage Turfs
                </a>
                <a href="{{ route('owner.manageSlots') }}" class="btn btn-outline-warning w-100 mb-2">Manage Slots</a>
                <a href="{{ route('owner.bookings') }}" class="btn btn-outline-info w-100">Review Bookings</a>
            </div>

            {{-- Turfs Summary --}}
            <div class="card p-3 shadow-sm">
                <h5 class="fw-bold mb-3">Your Turfs</h5>
                @forelse($turfs ?? [] as $turf)
                    <div class="d-flex justify-content-between align-items-center mb-2 pb-2 border-bottom">
                        <div>
                            <strong>{{ $turf->name }}</strong>
                            <div class="text-muted small">{{ $turf->sport_type }} | {{ $turf->bookings_count }} bookings</div>
                        </div>
                        <span class="badge bg-{{ $turf->status === 'active' ? 'success' : 'secondary' }}">
                            {{ ucfirst($turf->status) }}
                        </span>
                    </div>
                @empty
                    <p class="text-muted">No turfs yet. Add your first turf!</p>
                @endforelse
            </div>
        </div>
    </div>
</div>

<!-- Add Turf Modal -->
<div class="modal fade" id="addTurfModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Turf</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="{{ route('owner.turfs.store') }}">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Turf Name</label>
                        <input type="text" name="name" class="form-control" placeholder="e.g. Green Valley Football Turf" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Sport Type</label>
                        <input type="text" name="sport_type" class="form-control" placeholder="e.g. Football, Cricket, Tennis" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Location</label>
                        <input type="text" name="location" class="form-control" placeholder="e.g. Green Valley Sports Complex" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">City</label>
                        <input type="text" name="city" class="form-control" placeholder="e.g. Mumbai" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Base Price (₹)</label>
                        <input type="number" name="base_price" class="form-control" placeholder="e.g. 1200" min="0" step="0.01" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Image URL (Optional)</label>
                        <input type="url" name="image_url" class="form-control" placeholder="https://example.com/image.jpg">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Description (Optional)</label>
                        <textarea name="description" class="form-control" rows="3" placeholder="Brief description of this turf"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Status</label>
                        <select name="status" class="form-select" required>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-dark">Create Turf</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
