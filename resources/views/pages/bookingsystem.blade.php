@extends('layouts.master_navbar')

@section('content')
<style>
    body {
        background: #f8fafc;
        font-family: 'Inter', sans-serif;
    }

    /* ===== FIELD CARD ===== */
    .field-card {
        border-radius: 15px;
        overflow: hidden;
        transition: 0.4s;
        max-width: 900px;
        margin: auto;
    }
    .field-card:hover {
        transform: translateY(-5px);
        box-shadow: 0px 12px 25px rgba(0, 0, 0, 0.15);
    }
    .field-image {
        height: 350px;
        object-fit: cover;
        width: 100%;
        transition: 0.3s;
    }

    /* ===== BADGES ===== */
    .info-badge {
        background: #e8f5e9;
        color: #2e7d32;
        padding: 6px 14px;
        border-radius: 30px;
        font-size: 14px;
        font-weight: 600;
    }
    .location-tag {
        font-size: 15px;
        margin-top: 6px;
        color: #555;
    }

    /* ===== SLOTS ===== */
    .slot-box {
        cursor: pointer;
        transition: 0.25s;
        border: 2px solid #28a745;
        border-radius: 12px;
        background: #f8fff8;
        padding: 12px 6px;
        text-align: center;
        font-weight: 500;
    }
    .slot-box:hover {
        background: #e8f5e9;
        border-color: #1b5e20;
    }
    .slot-box.selected {
        background: #28a745 !important;
        color: #fff;
        border-color: #1b5e20;
    }

    /* ===== PAYMENT BUTTONS ===== */
    .payment-btn {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        padding: 10px;
        font-weight: 600;
        border-radius: 8px;
        cursor: pointer;
        border: none;
        transition: 0.3s;
        color: #fff;
    }
    .payment-btn img {
        height: 20px;
    }
    .payment-btn.active {
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        transform: translateY(-2px);
    }
    .payment-btn:hover {
        opacity: 0.9;
    }

    /* ===== FORMS & BUTTONS ===== */
    #payment-section input {
        border-radius: 8px;
        padding: 10px;
    }
    #confirm-booking {
        border-radius: 8px;
    }
</style>

<div class="container my-5">

    {{-- Page Title --}}
    <h2 class="fw-bold text-success text-center mb-2">
        {{ ucfirst($category) }} Fields
    </h2>
    <p class="text-center text-muted mb-5">
        Explore premium {{ $category }} turfs and book your slot instantly.
    </p>

    {{-- Field Card --}}
    <div class="card field-card shadow-sm mb-5">
        <img src="https://via.placeholder.com/900x350?text={{ ucfirst($category) }}+Field" class="field-image">
        <div class="card-body p-4">
            <h3 class="fw-bold mb-2 text-dark">Green Arena – {{ ucfirst($category) }} Turf</h3>
            <span class="info-badge mb-3 d-inline-block">{{ ucfirst($category) }} Turf</span>
            <p class="text-muted mb-3">
                Experience a top-quality {{ $category }} turf with night lighting, perfect grass,
                free parking, washroom facilities, and secure environment — ideal for both friendly matches
                and tournament games.
            </p>
            <p class="location-tag">
                <i class="bi bi-geo-alt-fill text-success"></i>
                <strong>Location:</strong> Dhanmondi, Dhaka
            </p>
        </div>
    </div>

    {{-- Slots Section --}}
    <div class="mb-5">
        <h4 class="fw-bold text-success mb-3">Select Date & Time Slot</h4>
        <input type="date" class="form-control w-auto mb-3" id="booking-date" value="{{ date('Y-m-d') }}">
        <div id="slots-container" class="row g-3"></div>
    </div>

    {{-- Customer & Payment Section --}}
    <div id="payment-section" class="card p-4 shadow-sm mb-4" style="display:none; max-width: 600px;">
        <h5 class="fw-bold text-success mb-3">Customer & Payment Details</h5>
        <input type="text" class="form-control mb-2" id="customer-name" placeholder="Enter your name">
        <input type="text" class="form-control mb-3" id="customer-number" placeholder="Enter your phone number">

        <h6 class="mb-2">Select Payment Method</h6>
        <div class="d-flex gap-3 mb-3">
            <button class="payment-btn" data-method="Bkash" style="background-color:#e60000;">
                <img src="https://upload.wikimedia.org/wikipedia/commons/3/38/Bkash_Logo.png"> Bkash
            </button>
            <button class="payment-btn" data-method="Nogod" style="background-color:#ff5f00;">
                <img src="https://www.nagad.com.bd/sites/default/files/nagad_logo.png"> Nogod
            </button>
            <button class="payment-btn" data-method="Rocket" style="background-color:#FF0000;">
                <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/Rocket_Bangladesh_Logo.png"> Rocket
            </button>
        </div>

        <input type="text" class="form-control mb-3" id="transaction-id" placeholder="Enter Transaction ID">

        <p><strong>Field:</strong> Green Arena – {{ ucfirst($category) }} Turf</p>
        <p><strong>Selected Slot:</strong> <span id="selected-slot"></span></p>

        <div class="d-flex gap-2">
            <button class="btn btn-secondary" id="back-to-slots">← Change Slot</button>
            <button class="btn btn-success" id="confirm-booking">Confirm Booking</button>
        </div>
    </div>

    {{-- Confirmation --}}
    <div id="booking-confirmation" class="alert alert-success" style="display:none;">
        🎉 Your booking is confirmed!
    </div>

</div>


<!-- FOOTER -->
<section>
    @include('pages.footer')
</section>

<script>
    const slotsContainer = document.getElementById('slots-container');
const paymentSection = document.getElementById('payment-section');
const bookingConfirmation = document.getElementById('booking-confirmation');
const selectedSlotSpan = document.getElementById('selected-slot');
const backButton = document.getElementById('back-to-slots');

// Convert 24-hour to 12-hour AM/PM format
function formatAMPM(hour) {
    const ampm = hour >= 12 ? 'PM' : 'AM';
    const hour12 = hour % 12 === 0 ? 12 : hour % 12;
    return `${hour12}:00 ${ampm}`;
}

function generateSlots(date) {
    slotsContainer.innerHTML = '';
    for (let hour = 8; hour < 24; hour++) {
        const start = formatAMPM(hour);
        const end = formatAMPM(hour + 1);
        const slotDiv = document.createElement('div');
        slotDiv.className = 'col-md-2';
        slotDiv.innerHTML = `<div class="slot-box" data-time="${start} - ${end}">${start} - ${end}</div>`;
        slotsContainer.appendChild(slotDiv);
    }

    // Slot click event
    document.querySelectorAll('.slot-box').forEach(slot => {
        slot.addEventListener('click', function() {
            document.querySelectorAll('.slot-box').forEach(s => s.classList.remove('selected'));
            this.classList.add('selected');
            selectedSlotSpan.textContent = this.dataset.time;
            paymentSection.style.display = 'block';
            bookingConfirmation.style.display = 'none';
            this.scrollIntoView({behavior: 'smooth', block: 'center'});
        });
    });
}

// Initialize slots
generateSlots(document.getElementById('booking-date').value);

// Change date event
document.getElementById('booking-date').addEventListener('change', function() {
    generateSlots(this.value);
    paymentSection.style.display = 'none';
    bookingConfirmation.style.display = 'none';
});

// Payment method selection
document.querySelectorAll('.payment-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        document.querySelectorAll('.payment-btn').forEach(b => b.classList.remove('active'));
        this.classList.add('active');
    });
});

// Back to slots
backButton.addEventListener('click', () => {
    paymentSection.style.display = 'none';
});

// Confirm booking
document.getElementById('confirm-booking').addEventListener('click', function() {
    const name = document.getElementById('customer-name').value.trim();
    const number = document.getElementById('customer-number').value.trim();
    const trx = document.getElementById('transaction-id').value.trim();
    const paymentMethod = document.querySelector('.payment-btn.active');

    if(!name || !number || !trx || !paymentMethod) {
        alert('Please fill all details and select a payment method.');
        return;
    }

    bookingConfirmation.style.display = 'block';
    window.scrollTo({top:0, behavior:'smooth'});
});

</script>
@endsection
