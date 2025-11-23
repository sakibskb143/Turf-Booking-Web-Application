@extends('layouts.owner_dashboard_layout')

@section('content')
<div class="container-fluid">

    <h3 class="fw-bold mb-4">Slot Management</h3>
    <p class="text-muted mb-4">Create and manage time slots for your fields.</p>

    {{-- Top Stats --}}
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card card-stats p-3 shadow-sm">
                <p class="mb-1 text-muted">Total Slots</p>
                <h4 class="fw-bold">4</h4>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card card-stats p-3 shadow-sm">
                <p class="mb-1 text-muted">Available</p>
                <h4 class="fw-bold text-success">2</h4>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card card-stats p-3 shadow-sm">
                <p class="mb-1 text-muted">Booked</p>
                <h4 class="fw-bold text-primary">1</h4>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card card-stats p-3 shadow-sm">
                <p class="mb-1 text-muted">Revenue Today</p>
                <h4 class="fw-bold text-purple">₹4,500</h4>
            </div>
        </div>
    </div>

    {{-- Slots Table --}}
    <div class="card shadow-sm p-3">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="fw-bold">All Slots</h5>
            <button class="btn btn-success">
                <i class="bi bi-plus-lg me-1"></i> Add Slot
            </button>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Field</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>Football Field A</td>
                        <td>2024-01-15</td>
                        <td><i class="bi bi-clock me-1"></i> 06:00 - 07:00</td>
                        <td>₹1200</td>
                        <td><span class="badge bg-success">Available</span></td>
                        <td class="text-center">
                            <button class="btn btn-outline-primary btn-sm"><i class="bi bi-pencil"></i></button>
                            <button class="btn btn-outline-danger btn-sm"><i class="bi bi-trash"></i></button>
                        </td>
                    </tr>

                    <tr>
                        <td>Football Field A</td>
                        <td>2024-01-15</td>
                        <td><i class="bi bi-clock me-1"></i> 18:00 - 19:00</td>
                        <td>₹1500</td>
                        <td><span class="badge bg-primary">Booked</span></td>
                        <td class="text-center">
                            <button class="btn btn-outline-primary btn-sm"><i class="bi bi-pencil"></i></button>
                            <button class="btn btn-outline-danger btn-sm"><i class="bi bi-trash"></i></button>
                        </td>
                    </tr>

                    <tr>
                        <td>Cricket Ground</td>
                        <td>2024-01-16</td>
                        <td><i class="bi bi-clock me-1"></i> 16:00 - 18:00</td>
                        <td>₹2000</td>
                        <td><span class="badge bg-success">Available</span></td>
                        <td class="text-center">
                            <button class="btn btn-outline-primary btn-sm"><i class="bi bi-pencil"></i></button>
                            <button class="btn btn-outline-danger btn-sm"><i class="bi bi-trash"></i></button>
                        </td>
                    </tr>

                    <tr>
                        <td>Football Field B</td>
                        <td>2024-01-16</td>
                        <td><i class="bi bi-clock me-1"></i> 19:00 - 20:00</td>
                        <td>₹1400</td>
                        <td><span class="badge bg-warning text-dark">Maintenance</span></td>
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
