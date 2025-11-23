@extends('layouts.owner_dashboard_layout')

@section('content')
<div class="container-fluid">

    <h3 class="fw-bold mb-3">Booking Management</h3>
    <p class="text-muted">Review and manage all booking requests for your fields.</p>

    {{-- Top Stats --}}
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card card-stats p-3 shadow-sm">
                <p class="text-muted mb-1">Total Bookings</p>
                <h4 class="fw-bold">8</h4>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card card-stats p-3 shadow-sm">
                <p class="text-muted mb-1">Pending Approval</p>
                <h4 class="fw-bold text-warning">2</h4>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card card-stats p-3 shadow-sm">
                <p class="text-muted mb-1">Confirmed</p>
                <h4 class="fw-bold text-success">5</h4>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card card-stats p-3 shadow-sm">
                <p class="text-muted mb-1">Cancelled</p>
                <h4 class="fw-bold text-danger">1</h4>
            </div>
        </div>
    </div>

    {{-- Filter Section --}}
    <div class="card p-3 shadow-sm mb-4">
        <h6 class="fw-bold mb-3">Filter Bookings</h6>

        <div class="row g-3">
            <div class="col-md-4">
                <input type="text" class="form-control" placeholder="Search by customer, booking ID or field">
            </div>

            <div class="col-md-3">
                <select class="form-select">
                    <option>All Status</option>
                    <option>Pending</option>
                    <option>Confirmed</option>
                    <option>Cancelled</option>
                </select>
            </div>

            <div class="col-md-3">
                <select class="form-select">
                    <option>All Categories</option>
                    <option>Football</option>
                    <option>Cricket</option>
                    <option>Tennis</option>
                </select>
            </div>

            <div class="col-md-2 text-end">
                <button class="btn btn-outline-secondary w-100">
                    <i class="bi bi-download me-1"></i> Export
                </button>
            </div>
        </div>
    </div>

    {{-- Bookings Table --}}
    <div class="card shadow-sm p-3">
        <h6 class="fw-bold mb-3">All Bookings (8)</h6>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Booking ID</th>
                        <th>Customer</th>
                        <th>Field</th>
                        <th>Date & Time</th>
                        <th>Status</th>
                        <th>Amount</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    {{-- Row 1 --}}
                    <tr>
                        <td>#BK101</td>
                        <td>John Doe</td>
                        <td>Football Field A</td>
                        <td>2024-01-15<br>06:00 - 07:00</td>
                        <td><span class="badge bg-warning text-dark">Pending</span></td>
                        <td>₹1200</td>
                        <td class="text-center">
                            <button class="btn btn-success btn-sm"><i class="bi bi-check"></i></button>
                            <button class="btn btn-danger btn-sm"><i class="bi bi-x"></i></button>
                        </td>
                    </tr>

                    {{-- Row 2 --}}
                    <tr>
                        <td>#BK102</td>
                        <td>Sarah Wilson</td>
                        <td>Cricket Ground</td>
                        <td>2024-01-16<br>18:00 - 20:00</td>
                        <td><span class="badge bg-success">Confirmed</span></td>
                        <td>₹2000</td>
                        <td class="text-center">
                            <button class="btn btn-outline-primary btn-sm"><i class="bi bi-eye"></i></button>
                        </td>
                    </tr>

                    {{-- Row 3 --}}
                    <tr>
                        <td>#BK103</td>
                        <td>Mark Stevens</td>
                        <td>Tennis Court 1</td>
                        <td>2024-01-16<br>16:00 - 17:00</td>
                        <td><span class="badge bg-danger">Cancelled</span></td>
                        <td>₹700</td>
                        <td class="text-center">
                            <button class="btn btn-outline-primary btn-sm"><i class="bi bi-eye"></i></button>
                        </td>
                    </tr>

                    {{-- Add more rows here as needed --}}
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
