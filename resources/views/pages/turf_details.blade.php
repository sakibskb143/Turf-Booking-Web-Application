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

<!-- Booking Modal - Modernized -->
@auth
@if(auth()->user()->role === 'user')
<div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header border-0 pb-0">
                <h4 class="modal-title fw-bold" id="bookingModalLabel">Confirm Your Booking</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="bookingForm" method="POST" action="{{ route('bookings.store') }}">
                @csrf
                <input type="hidden" name="slot_id" id="modal_slot_id">
                <input type="hidden" id="modal_turf_image" value="">
                <div class="modal-body px-4">
                    <div class="row g-4">
                        <!-- Left Column: Turf Image & Details -->
                        <div class="col-lg-5">
                            <div class="card border-0 shadow-sm h-100">
                                <img id="modal_turf_image_display" src="" alt="Turf" class="card-img-top" style="height: 250px; object-fit: cover; border-radius: 8px 8px 0 0;">
                                <div class="card-body">
                                    <h5 class="card-title fw-bold mb-2" id="modal_turf_name"></h5>
                                    <p class="text-muted mb-3">
                                        <i class="fas fa-map-marker-alt text-success"></i> 
                                        <span id="modal_turf_location"></span>
                                    </p>
                                    <div class="d-flex align-items-center justify-content-between p-3 bg-light rounded">
                                        <div>
                                            <small class="text-muted d-block">Selected Slot</small>
                                            <strong id="modal_slot_time" class="d-block"></strong>
                                            <small class="text-muted" id="modal_slot_date"></small>
                                        </div>
                                        <div class="text-end">
                                            <small class="text-muted d-block">Total Amount</small>
                                            <h4 class="fw-bold text-success mb-0">₹<span id="modal_slot_price"></span></h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Right Column: User Info & Payment -->
                        <div class="col-lg-7">
                            <!-- User Information -->
                            <div class="mb-4">
                                <h6 class="fw-bold mb-3">
                                    <i class="fas fa-user-circle text-success"></i> Your Information
                                </h6>
                                <div class="card bg-light border-0 p-3">
                                    <p class="mb-1">
                                        <strong>{{ auth()->user()->name }}</strong>
                                    </p>
                                    <p class="mb-1 text-muted small">
                                        <i class="fas fa-map-marker-alt"></i> 
                                        {{ auth()->user()->address ?? 'No address provided' }}
                                    </p>
                                    <p class="mb-0 text-muted small">
                                        <i class="fas fa-phone"></i> {{ auth()->user()->phone ?? 'N/A' }}
                                    </p>
                                </div>
                            </div>

                            <!-- Payment Method -->
                            <div class="mb-4">
                                <h6 class="fw-bold mb-3">
                                    <i class="fas fa-credit-card text-success"></i> Payment Method
                                </h6>
                                <div class="d-flex flex-column gap-2">
                                    <label class="payment-radio-option">
                                        <input type="radio" name="payment_method" value="Bkash" required>
                                        <div class="payment-option-content">
                                            <img src="https://upload.wikimedia.org/wikipedia/commons/3/38/Bkash_Logo.png" alt="Bkash" class="payment-icon">
                                            <span class="fw-semibold">Bkash</span>
                                        </div>
                                    </label>
                                    <label class="payment-radio-option">
                                        <input type="radio" name="payment_method" value="Rocket" required>
                                        <div class="payment-option-content">
                                            <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/Rocket_Bangladesh_Logo.png" alt="Rocket" class="payment-icon">
                                            <span class="fw-semibold">Rocket</span>
                                        </div>
                                    </label>
                                    <label class="payment-radio-option">
                                        <input type="radio" name="payment_method" value="Nagad" required>
                                        <div class="payment-option-content">
                                            <img src="https://www.nagad.com.bd/sites/default/files/nagad_logo.png" alt="Nagad" class="payment-icon">
                                            <span class="fw-semibold">Nagad</span>
                                        </div>
                                    </label>
                                </div>
                            </div>

                            <!-- Transaction ID -->
                            <div class="mb-3">
                                <label for="transaction_id" class="form-label fw-bold">
                                    <i class="fas fa-receipt text-success"></i> Transaction ID
                                </label>
                                <input type="text" 
                                       class="form-control form-control-lg" 
                                       id="transaction_id" 
                                       name="transaction_id" 
                                       placeholder="Enter transaction ID from payment confirmation" 
                                       required>
                                <small class="text-muted">Please enter the transaction ID you received after payment.</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 bg-light px-4 py-3">
                    <button type="button" class="btn btn-outline-secondary px-4" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success btn-lg px-5 fw-bold">
                        <i class="fas fa-check-circle me-2"></i>Confirm Booking
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .payment-radio-option {
        cursor: pointer;
        display: block;
        margin: 0;
    }
    .payment-radio-option input[type="radio"] {
        display: none;
    }
    .payment-option-content {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 14px 16px;
        border: 2px solid #e5e7eb;
        border-radius: 10px;
        background: white;
        transition: all 0.3s ease;
    }
    .payment-icon {
        height: 32px;
        width: auto;
    }
    .payment-radio-option input[type="radio"]:checked + .payment-option-content {
        border-color: #28a745;
        background: #f0fdf4;
        box-shadow: 0 0 0 3px rgba(40, 167, 69, 0.1);
    }
    .payment-radio-option:hover .payment-option-content {
        border-color: #28a745;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
</style>

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
            const turfImage = button.getAttribute('data-turf-image') || 'https://via.placeholder.com/400x250?text=' + encodeURIComponent(turfName);
            const slotTime = button.getAttribute('data-slot-time');
            const slotDate = button.getAttribute('data-slot-date');
            const slotPrice = button.getAttribute('data-slot-price');

            document.getElementById('modal_slot_id').value = slotId;
            document.getElementById('modal_turf_name').textContent = turfName;
            document.getElementById('modal_turf_location').textContent = turfLocation;
            document.getElementById('modal_turf_image_display').src = turfImage;
            document.getElementById('modal_turf_image').value = turfImage;
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
@endif
@endauth

@endsection

