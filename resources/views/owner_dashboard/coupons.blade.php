@extends('layouts.owner_dashboard_layout')

@section('content')
<div class="container-fluid">

    <h3 class="fw-bold mb-3">Coupon Management</h3>
    <p class="text-muted">Create and manage discount coupons for your customers.</p>

    {{-- Stats --}}
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card card-stats p-3 shadow-sm">
                <p class="text-muted mb-1">Total Coupons</p>
                <h4 class="fw-bold">4</h4>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card card-stats p-3 shadow-sm">
                <p class="text-muted mb-1">Active Coupons</p>
                <h4 class="fw-bold text-success">3</h4>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card card-stats p-3 shadow-sm">
                <p class="text-muted mb-1">Total Usage</p>
                <h4 class="fw-bold text-purple">232</h4>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card card-stats p-3 shadow-sm">
                <p class="text-muted mb-1">Customer Savings</p>
                <h4 class="fw-bold text-orange">₹62,875</h4>
            </div>
        </div>
    </div>

    {{-- Coupon Table --}}
    <div class="card shadow-sm p-3">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="fw-bold">All Coupons</h5>
            <button class="btn btn-dark">
                <i class="bi bi-plus-lg me-1"></i> Create Coupon
            </button>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Coupon Code</th>
                        <th>Type</th>
                        <th>Value</th>
                        <th>Usage</th>
                        <th>Expiry Date</th>
                        <th>Status</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>

                <tbody>

                    {{-- Static mockup (replace with DB later) --}}
                    <tr>
                        <td>
                            <strong>WELCOME20</strong>
                            <div class="text-muted small">Welcome discount for new customers</div>
                        </td>
                        <td><span class="badge bg-primary">Percentage</span></td>
                        <td>20%</td>
                        <td>15 / 100<br><small class="text-muted">15% used</small></td>
                        <td>2024-03-31</td>
                        <td><span class="badge bg-success">Active</span></td>
                        <td class="text-center">
                            <button class="btn btn-outline-primary btn-sm"><i class="bi bi-pencil"></i></button>
                            <button class="btn btn-outline-danger btn-sm"><i class="bi bi-trash"></i></button>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <strong>FLAT500</strong>
                            <div class="text-muted small">Flat ₹500 off on bookings above ₹2000</div>
                        </td>
                        <td><span class="badge bg-secondary">Flat Amount</span></td>
                        <td>₹500</td>
                        <td>32 / 50<br><small class="text-muted">64% used</small></td>
                        <td>2024-02-28</td>
                        <td><span class="badge bg-success">Active</span></td>
                        <td class="text-center">
                            <button class="btn btn-outline-primary btn-sm"><i class="bi bi-pencil"></i></button>
                            <button class="btn btn-outline-danger btn-sm"><i class="bi bi-trash"></i></button>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <strong>WEEKEND15</strong>
                            <div class="text-muted small">Weekend special discount</div>
                        </td>
                        <td><span class="badge bg-primary">Percentage</span></td>
                        <td>15%</td>
                        <td>180 / 200<br><small class="text-muted">90% used</small></td>
                        <td>2024-01-31</td>
                        <td><span class="badge bg-danger">Expired</span></td>
                        <td class="text-center">
                            <button class="btn btn-outline-primary btn-sm"><i class="bi bi-pencil"></i></button>
                            <button class="btn btn-outline-danger btn-sm"><i class="bi bi-trash"></i></button>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <strong>CRICKET25</strong>
                            <div class="text-muted small">Special discount for cricket bookings</div>
                        </td>
                        <td><span class="badge bg-primary">Percentage</span></td>
                        <td>25%</td>
                        <td>5 / 75<br><small class="text-muted">7% used</small></td>
                        <td>2024-04-30</td>
                        <td><span class="badge bg-success">Active</span></td>
                        <td class="text-center">
                            <button class="btn btn-outline-primary btn-sm"><i class="bi bi-pencil"></i></button>
                            <button class="btn btn-outline-danger btn-sm"><i class="bi bi-trash"></i></button>
                        </td>
                    </tr>

                </tbody>

            </table>
        </div>
    </div>

</div>
@endsection
