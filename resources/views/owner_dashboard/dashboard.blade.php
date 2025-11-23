@extends('layouts.owner_dashboard_layout')

@section('content')
<div class="container-fluid">
    <h3 class="fw-bold mb-4">Owner Dashboard</h3>

    {{-- Top Stats --}}
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card card-stats p-3 shadow-sm">
                <p class="mb-1 text-muted">Today's Revenue</p>
                <h5 class="fw-bold">₹4,500</h5>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-stats p-3 shadow-sm">
                <p class="mb-1 text-muted">This Week</p>
                <h5 class="fw-bold">₹28,500</h5>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-stats p-3 shadow-sm">
                <p class="mb-1 text-muted">This Month</p>
                <h5 class="fw-bold">₹125,000</h5>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-stats p-3 shadow-sm">
                <p class="mb-1 text-muted">Growth Rate</p>
                <h5 class="fw-bold text-success">+12.5%</h5>
            </div>
        </div>
    </div>

    {{-- Latest Bookings --}}
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card p-3 shadow-sm">
                <h5 class="fw-bold mb-3">Latest Bookings</h5>
                <div class="list-group">
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <strong>John Doe</strong>
                            <span class="status-badge status-confirmed ms-2">Confirmed</span>
                            <div class="text-muted">Football Field 1 | 2025-11-23 | 10:00 AM - 11:00 AM | ₹400</div>
                        </div>
                        <button class="btn btn-sm btn-outline-primary">View Details</button>
                    </div>

                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <strong>Sarah Wilson</strong>
                            <span class="status-badge status-pending ms-2">Pending</span>
                            <div class="text-muted">Cricket Ground | 2025-11-23 | 11:00 AM - 12:00 PM | ₹500</div>
                        </div>
                        <div>
                            <button class="btn btn-sm btn-success me-1">Approve</button>
                            <button class="btn btn-sm btn-danger">Reject</button>
                        </div>
                    </div>
                    {{-- More bookings --}}
                </div>
            </div>
        </div>

        {{-- Quick Actions --}}
        <div class="col-lg-4">
            <div class="card p-3 shadow-sm mb-4">
                <h5 class="fw-bold mb-3">Quick Actions</h5>
                <button class="btn btn-success w-100 mb-2">Add New Turf</button>
                <a href="{{ route('owner.manageTurf') }}" class="btn btn-outline-primary w-100 mb-2">
    Manage Turfs
</a>

                <button class="btn btn-outline-warning w-100 mb-2">Create Coupons</button>
                <button class="btn btn-outline-info w-100">Review Bookings</button>
            </div>
        </div>
    </div>
</div>
@endsection
