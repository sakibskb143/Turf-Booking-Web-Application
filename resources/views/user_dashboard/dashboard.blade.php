@extends('layouts.user_dashboard_layout')

@section('content')
<h2 class="fw-bold mb-4">Dashboard</h2>

<div class="row">
    <!-- Total Bookings -->
    <div class="col-md-3">
        <div class="p-3 bg-white shadow-sm rounded">
            <h6>Total Bookings</h6>
            <h3 class="fw-bold">12</h3>
        </div>
    </div>

    <!-- This Month -->
    <div class="col-md-3">
        <div class="p-3 bg-white shadow-sm rounded">
            <h6>This Month</h6>
            <h3 class="fw-bold">3</h3>
        </div>
    </div>

    <!-- Money Spent -->
    <div class="col-md-3">
        <div class="p-3 bg-white shadow-sm rounded">
            <h6>Amount Spent</h6>
            <h3 class="fw-bold">₹18,500</h3>
        </div>
    </div>

    <!-- Favorite Sport -->
    <div class="col-md-3">
        <div class="p-3 bg-white shadow-sm rounded">
            <h6>Favorite Sport</h6>
            <h3 class="fw-bold">Football</h3>
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

            <!-- Booking Item -->
            <div class="border rounded p-3 mb-3 d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="fw-bold mb-1">Green Valley Football Field A</h6>
                    <p class="mb-0 text-muted small">
                        <i class="bi bi-calendar"></i> 2024-01-15 &nbsp;&nbsp; 
                        <i class="bi bi-clock"></i> 18:00 - 19:00 &nbsp;&nbsp; 
                        ₹1200
                    </p>
                </div>
                <div>
                    <span class="badge bg-success">Confirmed</span>
                    <button class="btn btn-outline-danger btn-sm ms-2">Cancel</button>
                </div>
            </div>

            <div class="border rounded p-3 mb-3 d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="fw-bold mb-1">City Cricket Ground</h6>
                    <p class="mb-0 text-muted small">
                        <i class="bi bi-calendar"></i> 2024-01-18 &nbsp;&nbsp; 
                        <i class="bi bi-clock"></i> 16:00 - 18:00 &nbsp;&nbsp; 
                        ₹2000
                    </p>
                </div>
                <span class="badge bg-warning text-dark">Pending</span>
            </div>

            <div class="border rounded p-3 mb-3 d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="fw-bold mb-1">Sports Complex Field B</h6>
                    <p class="mb-0 text-muted small">
                        <i class="bi bi-calendar"></i> 2024-01-20 &nbsp;&nbsp; 
                        <i class="bi bi-clock"></i> 19:00 - 20:00 &nbsp;&nbsp; 
                        ₹1500
                    </p>
                </div>
                <div>
                    <span class="badge bg-success">Confirmed</span>
                    <button class="btn btn-outline-danger btn-sm ms-2">Cancel</button>
                </div>
            </div>

            <div class="text-center mt-3">
                <a href="#" class="btn btn-outline-dark">View All Bookings</a>
            </div>
        </div>
    </div>

    <!-- Notifications -->
    <div class="col-md-4">
        <div class="bg-white p-3 shadow-sm rounded">
            <h5 class="fw-bold mb-3">Notifications</h5>
            <p class="text-muted small">Recent updates and reminders</p>

            <div class="border rounded p-3 mb-3">
                <p class="mb-1">
                    Your booking at Green Valley Football Field A is tomorrow at 6:00 PM
                </p>
                <small class="text-muted">2 hours ago</small>
            </div>

            <div class="border rounded p-3 mb-3">
                <p class="mb-1">Payment of ₹1,200 confirmed for booking #1001</p>
                <small class="text-muted">1 day ago</small>
            </div>

            <div class="border rounded p-3 mb-3">
                <p class="mb-1">Your booking request is pending approval</p>
                <small class="text-muted">2 days ago</small>
            </div>

            <div class="text-center mt-3">
                <a href="#" class="btn btn-outline-dark">View All Notifications</a>
            </div>
        </div>
    </div>
</div>

@endsection
