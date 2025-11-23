@extends('layouts.user_dashboard_layout')

@section('content')

<h2 class="fw-bold mb-1">Booking History</h2>
<p class="text-muted mb-4">View and manage all your past turf bookings.</p>

<!-- Stats -->
<div class="row mb-4">
    <div class="col-md-4">
        <div class="shadow-sm p-3 border rounded text-center bg-white">
            <h3 class="fw-bold mb-0">6</h3>
            <p class="text-muted mb-0">Total Bookings</p>
        </div>
    </div>

    <div class="col-md-4">
        <div class="shadow-sm p-3 border rounded text-center bg-white">
            <h3 class="fw-bold mb-0">4</h3>
            <p class="text-muted mb-0">Completed</p>
        </div>
    </div>

    <div class="col-md-4">
        <div class="shadow-sm p-3 border rounded text-center bg-white">
            <h3 class="fw-bold mb-0">₹7,600</h3>
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

            <tr>
                <td>BK001</td>
                <td>2024-01-10</td>
                <td>Green Valley Football Field A</td>
                <td>18:00 - 19:00</td>
                <td><span class="badge bg-success">Completed</span></td>
                <td><span class="badge bg-primary">Paid</span></td>
                <td>₹1200</td>
                <td><button class="btn btn-sm btn-outline-dark">View</button></td>
            </tr>

            <tr>
                <td>BK002</td>
                <td>2024-01-08</td>
                <td>City Cricket Ground</td>
                <td>16:00 - 18:00</td>
                <td><span class="badge bg-success">Completed</span></td>
                <td><span class="badge bg-primary">Paid</span></td>
                <td>₹2000</td>
                <td><button class="btn btn-sm btn-outline-dark">View</button></td>
            </tr>

            <tr>
                <td>BK003</td>
                <td>2024-01-05</td>
                <td>Sports Complex Court 1</td>
                <td>19:00 - 20:00</td>
                <td><span class="badge bg-danger">Cancelled</span></td>
                <td><span class="badge bg-info text-dark">Refunded</span></td>
                <td>₹800</td>
                <td><button class="btn btn-sm btn-outline-dark">View</button></td>
            </tr>

            <tr>
                <td>BK004</td>
                <td>2024-01-03</td>
                <td>Green Valley Football Field B</td>
                <td>17:00 - 18:00</td>
                <td><span class="badge bg-success">Completed</span></td>
                <td><span class="badge bg-primary">Paid</span></td>
                <td>₹1400</td>
                <td><button class="btn btn-sm btn-outline-dark">View</button></td>
            </tr>

            <tr>
                <td>BK005</td>
                <td>2023-12-28</td>
                <td>Tennis Court Premium</td>
                <td>15:00 - 16:00</td>
                <td><span class="badge bg-success">Completed</span></td>
                <td><span class="badge bg-primary">Paid</span></td>
                <td>₹1000</td>
                <td><button class="btn btn-sm btn-outline-dark">View</button></td>
            </tr>

            <tr>
                <td>BK006</td>
                <td>2023-12-25</td>
                <td>City Cricket Ground</td>
                <td>14:00 - 16:00</td>
                <td><span class="badge bg-warning text-dark">No Show</span></td>
                <td><span class="badge bg-primary">Paid</span></td>
                <td>₹2000</td>
                <td><button class="btn btn-sm btn-outline-dark">View</button></td>
            </tr>

        </tbody>
    </table>
</div>

@endsection
