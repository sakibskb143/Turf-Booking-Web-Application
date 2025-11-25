@extends('layouts.master_navbar')

@section('content')
<style>
    body {
        background: #f8fafc;
        font-family: 'Inter', sans-serif;
    }

    .turf-card {
        border-radius: 15px;
        overflow: hidden;
        transition: transform 0.3s, box-shadow 0.3s;
        margin-bottom: 2rem;
    }

    .turf-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }

    .turf-image {
        height: 300px;
        object-fit: cover;
        width: 100%;
    }

    .slot-box {
        cursor: pointer;
        transition: 0.25s;
        border: 2px solid #28a745;
        border-radius: 12px;
        background: #f8fff8;
        padding: 12px;
        text-align: center;
        font-weight: 500;
        margin-bottom: 10px;
    }

    .slot-box:hover:not(.booked) {
        background: #e8f5e9;
        border-color: #1b5e20;
    }

    .slot-box.selected {
        background: #28a745 !important;
        color: #fff;
        border-color: #1b5e20;
    }

    .slot-box.booked {
        background: #f5f5f5;
        border-color: #ccc;
        color: #999;
        cursor: not-allowed;
    }

    .payment-method-card {
        cursor: pointer;
        margin: 0;
    }

    .payment-method-card input[type="radio"] {
        display: none;
    }

    .payment-method-card .card {
        border: 2px solid #dee2e6;
        transition: all 0.3s;
    }

    .payment-method-card input[type="radio"]:checked + .card {
        border-color: #28a745;
        background-color: #f0f9f4;
        box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
    }

    .payment-method-card:hover .card {
        border-color: #28a745;
    }
</style>

<div class="container my-5">
    <h2 class="fw-bold text-success text-center mb-2">
        {{ isset($category) ? ucfirst($category) . ' Fields' : 'Turf Details' }}
    </h2>
    <p class="text-center text-muted mb-5">
        @if(isset($category))
            Explore premium {{ $category }} turfs and book your slot instantly.
        @else
            View full details and available slots for this turf.
        @endif
    </p>

    @if(isset($turf))
        @include('pages.partials.turf_detail_card', ['turf' => $turf, 'selectedDate' => $selectedDate])
    @else
        @forelse($turfs as $turf)
            @include('pages.partials.turf_detail_card', ['turf' => $turf, 'selectedDate' => $selectedDate])
        @empty
            <div class="alert alert-info text-center">
                <h5>No turfs available</h5>
                <p>There are no {{ isset($category) ? $category : '' }} turfs available at the moment.</p>
            </div>
        @endforelse
    @endif
</div>

<!-- Booking Modal -->
@auth
@if(auth()->user()->role === 'user')
<div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="bookingModalLabel">
                    <i class="fas fa-calendar-check"></i> Confirm Your Booking
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="bookingForm" method="POST" action="{{ route('bookings.store') }}">
                @csrf
                <input type="hidden" name="slot_id" id="modal_slot_id">
                <div class="modal-body">
                    <!-- Booking Details -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h6 class="fw-bold text-success mb-3">
                                <i class="fas fa-map-marker-alt"></i> Your Address
                            </h6>
                            <div class="card bg-light p-3">
                                <p class="mb-0">
                                    <strong>{{ auth()->user()->name }}</strong><br>
                                    {{ auth()->user()->address ?? 'No address provided' }}<br>
                                    <small class="text-muted">
                                        <i class="fas fa-phone"></i> {{ auth()->user()->phone ?? 'N/A' }}
                                    </small>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h6 class="fw-bold text-success mb-3">
                                <i class="fas fa-building"></i> Turf Address
                            </h6>
                            <div class="card bg-light p-3">
                                <p class="mb-0" id="modal_turf_address">
                                    <strong id="modal_turf_name"></strong><br>
                                    <span id="modal_turf_location"></span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Selected Slot -->
                    <div class="alert alert-info mb-4">
                        <h6 class="fw-bold mb-2">
                            <i class="fas fa-clock"></i> Selected Slot
                        </h6>
                        <p class="mb-0">
                            <strong>Date:</strong> <span id="modal_slot_date"></span><br>
                            <strong>Time:</strong> <span id="modal_slot_time"></span><br>
                            <strong>Price:</strong> <span class="text-success fw-bold">₹<span id="modal_slot_price"></span></span>
                        </p>
                    </div>

                    <!-- Payment Method -->
                    <div class="mb-4">
                        <h6 class="fw-bold mb-3">
                            <i class="fas fa-credit-card"></i> Select Payment Method
                        </h6>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="payment-method-card">
                                    <input type="radio" name="payment_method" value="Bkash" required>
                                    <div class="card text-center h-100">
                                        <div class="card-body">
                                            <div class="mb-2">
                                                <img src="https://upload.wikimedia.org/wikipedia/commons/3/38/Bkash_Logo.png" 
                                                     alt="Bkash" style="height: 30px;">
                                            </div>
                                            <strong>Bkash</strong>
                                        </div>
                                    </div>
                                </label>
                            </div>
                            <div class="col-md-4">
                                <label class="payment-method-card">
                                    <input type="radio" name="payment_method" value="Rocket" required>
                                    <div class="card text-center h-100">
                                        <div class="card-body">
                                            <div class="mb-2">
                                                <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/Rocket_Bangladesh_Logo.png" 
                                                     alt="Rocket" style="height: 30px;">
                                            </div>
                                            <strong>Rocket</strong>
                                        </div>
                                    </div>
                                </label>
                            </div>
                            <div class="col-md-4">
                                <label class="payment-method-card">
                                    <input type="radio" name="payment_method" value="Nagad" required>
                                    <div class="card text-center h-100">
                                        <div class="card-body">
                                            <div class="mb-2">
                                                <img src="https://www.nagad.com.bd/sites/default/files/nagad_logo.png" 
                                                     alt="Nagad" style="height: 30px;">
                                            </div>
                                            <strong>Nagad</strong>
                                        </div>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Transaction ID -->
                    <div class="mb-4">
                        <label for="transaction_id" class="form-label fw-bold">
                            <i class="fas fa-receipt"></i> Transaction ID
                        </label>
                        <input type="text" 
                               class="form-control" 
                               id="transaction_id" 
                               name="transaction_id" 
                               placeholder="Enter your transaction ID" 
                               required>
                        <small class="text-muted">Please enter the transaction ID from your payment confirmation.</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-check-circle"></i> Confirm Booking
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif
@endauth

<script>
document.addEventListener('DOMContentLoaded', function() {
    const bookingModal = document.getElementById('bookingModal');
    if (bookingModal) {
        bookingModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const slotId = button.getAttribute('data-slot-id');
            const turfId = button.getAttribute('data-turf-id');
            const turfName = button.getAttribute('data-turf-name');
            const turfLocation = button.getAttribute('data-turf-location');
            const slotTime = button.getAttribute('data-slot-time');
            const slotDate = button.getAttribute('data-slot-date');
            const slotPrice = button.getAttribute('data-slot-price');

            document.getElementById('modal_slot_id').value = slotId;
            document.getElementById('modal_turf_name').textContent = turfName;
            document.getElementById('modal_turf_location').textContent = turfLocation;
            document.getElementById('modal_slot_time').textContent = slotTime;
            document.getElementById('modal_slot_date').textContent = new Date(slotDate).toLocaleDateString('en-US', { 
                weekday: 'long', 
                year: 'numeric', 
                month: 'long', 
                day: 'numeric' 
            });
            document.getElementById('modal_slot_price').textContent = parseFloat(slotPrice).toFixed(2);
        });
    }
});
</script>

@endsection

