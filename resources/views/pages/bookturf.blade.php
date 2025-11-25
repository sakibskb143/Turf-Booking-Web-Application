@extends('layouts.master_navbar')

@section('content')
<style>
    body {
        background: #f8fafc;
        font-family: 'Inter', sans-serif;
    }

    /* ===== HERO SECTION ===== */
    .hero-section {
        background: linear-gradient(135deg, #00b050 0%, #008040 100%);
        color: white;
        padding: 4rem 0;
        margin-bottom: 3rem;
    }

    /* ===== SECTION TITLES ===== */
    .section-title {
        text-align: center;
        font-weight: 700;
        color: #111827;
        margin-bottom: 2rem;
        position: relative;
    }

    .section-title:after {
        content: '';
        display: block;
        width: 60px;
        height: 4px;
        background: #00b050;
        margin: 0.5rem auto;
        border-radius: 2px;
    }

    /* ===== CATEGORY & FIELD CARDS ===== */
    .category-card, .field-card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        transition: transform 0.2s ease;
        height: 100%;
    }

    .category-card:hover, .field-card:hover {
        transform: translateY(-5px);
    }

    .category-card img, .field-card img {
        border-radius: 15px 15px 0 0;
        height: 180px;
        object-fit: cover;
    }

    /* ===== FILTER BAR ===== */
    .filter-bar {
        background: #ffffff;
        padding: 1.5rem;
        border-radius: 12px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.05);
        margin-bottom: 2rem;
    }

    /* ===== AVAILABILITY BADGE ===== */
    .badge-available {
        background-color: #00b050;
        color: #fff;
        padding: 0.25rem 0.5rem;
        font-size: 0.75rem;
        border-radius: 5px;
    }

    .badge-booked {
        background-color: #ff4d4f;
        color: #fff;
        padding: 0.25rem 0.5rem;
        font-size: 0.75rem;
        border-radius: 5px;
    }

    .badge-popular {
        background-color: #ff6b00;
        color: #fff;
        padding: 0.25rem 0.5rem;
        font-size: 0.75rem;
        border-radius: 5px;
    }

    .field-price {
        font-weight: 700;
        color: #00b050;
        margin-top: 0.5rem;
    }

    .btn-book {
        margin-top: 0.5rem;
    }

    /* ===== FEATURES SECTION ===== */
    .feature-card {
        text-align: center;
        padding: 2rem 1rem;
        border-radius: 12px;
        transition: all 0.3s ease;
    }

    .feature-card:hover {
        background: white;
        box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        transform: translateY(-5px);
    }

    .feature-icon {
        font-size: 2.5rem;
        color: #00b050;
        margin-bottom: 1rem;
    }

    /* ===== TESTIMONIALS ===== */
    .testimonial-card {
        background: white;
        border-radius: 15px;
        padding: 2rem;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        margin: 1rem 0;
    }

    .testimonial-text {
        font-style: italic;
        color: #555;
        margin-bottom: 1rem;
    }

    .testimonial-author {
        font-weight: 600;
        color: #333;
    }

    /* ===== STATS SECTION ===== */
    .stats-section {
        background: linear-gradient(135deg, #111827 0%, #1f2937 100%);
        color: white;
        padding: 4rem 0;
        border-radius: 20px;
        margin: 4rem 0;
    }

    .stat-number {
        font-size: 2.5rem;
        font-weight: 700;
        color: #00b050;
        margin-bottom: 0.5rem;
    }

    /* ===== LOCATION SECTION ===== */
    .location-card {
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        transition: transform 0.3s ease;
    }

    .location-card:hover {
        transform: translateY(-5px);
    }

    /* ===== SORTING OPTIONS ===== */
    .sort-options {
        background: #ffffff;
        padding: 1rem 1.5rem;
        border-radius: 12px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.05);
        margin-bottom: 1.5rem;
    }

    /* ===== CARD ENHANCEMENTS ===== */
    .card-rating {
        color: #ffc107;
        font-size: 0.9rem;
    }

    .card-amenities {
        font-size: 0.8rem;
        color: #6c757d;
    }

    .amenity-icon {
        margin-right: 5px;
    }
</style>

<!-- HERO SECTION -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="display-4 fw-bold mb-3">Book Your Perfect Turf</h1>
                <p class="lead mb-4">Find and reserve premium sports facilities for football, cricket, tennis and more. Easy booking, instant confirmation.</p>
                <div class="d-flex gap-3">
                    <a href="#available-slots" class="btn btn-light btn-lg">Book Now</a>
                    <a href="#how-it-works" class="btn btn-outline-light btn-lg">How It Works</a>
                </div>
            </div>
            <div class="col-lg-6 text-center">
                <img src="https://images.unsplash.com/photo-1551698618-1dfe5d97d256?ixlib=rb-4.1.0&auto=format&fit=crop&q=80&w=800" alt="Sports Turf" class="img-fluid rounded-3 shadow-lg">
            </div>
        </div>
    </div>
</section>

<!-- FEATURES SECTION -->
<section class="container my-5">
    <h2 class="section-title">Why Choose TurfBooker?</h2>
    <div class="row g-4">
        <div class="col-md-3">
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-bolt"></i>
                </div>
                <h5>Instant Booking</h5>
                <p class="text-muted">Book your slot in seconds with instant confirmation</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-map-marker-alt"></i>
                </div>
                <h5>Best Locations</h5>
                <p class="text-muted">Premium turfs at convenient locations across the city</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h5>Secure Payment</h5>
                <p class="text-muted">100% secure payments with multiple options</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-headset"></i>
                </div>
                <h5>24/7 Support</h5>
                <p class="text-muted">Round-the-clock customer support for all your queries</p>
            </div>
        </div>
    </div>
</section>

<!-- CATEGORIES SECTION -->
<section class="container my-5">
    <h2 class="section-title">Explore Categories</h2>
    <div class="row g-4">

        <div class="col-md-4">
            <div class="card category-card">
                <img src="https://images.unsplash.com/photo-1607414721186-5309963d7b52?auto=format&fit=crop&w=436" class="card-img-top" alt="Football">
                <div class="card-body text-center">
                    <h5 class="card-title fw-bold">Football</h5>
                    <p class="text-muted">Book premium football fields and practice grounds.</p>

                    <a href="{{ route('booking.system', 'football') }}" class="btn btn-success btn-sm">
                        View Fields
                    </a>

                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card category-card">
                <img src="https://images.unsplash.com/photo-1671209151455-86980f5bf293?auto=format&fit=crop&w=435" class="card-img-top" alt="Cricket">
                <div class="card-body text-center">
                    <h5 class="card-title fw-bold">Cricket</h5>
                    <p class="text-muted">Rent quality turfs and nets for cricket practice or matches.</p>

                    <a href="{{ route('booking.system', 'cricket') }}" class="btn btn-success btn-sm">
                        View Fields
                    </a>

                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card category-card">
                <img src="https://images.unsplash.com/photo-1615294295454-1f3dcdc86468?auto=format&fit=crop&w=1032" class="card-img-top" alt="Tennis">
                <div class="card-body text-center">
                    <h5 class="card-title fw-bold">Tennis</h5>
                    <p class="text-muted">Find professional tennis courts in your area.</p>

                    <a href="{{ route('booking.system', 'tennis') }}" class="btn btn-success btn-sm">
                        View Fields
                    </a>

                </div>
            </div>
        </div>

    </div>
</section>


<!-- HOW IT WORKS SECTION -->
<section id="how-it-works" class="container my-5">
    <h2 class="section-title">How It Works</h2>
    <div class="row g-4">
        <div class="col-md-4 text-center">
            <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                <span class="h4 mb-0">1</span>
            </div>
            <h5>Search & Select</h5>
            <p class="text-muted">Find available turf slots based on your preferred location, date, and sport</p>
        </div>
        <div class="col-md-4 text-center">
            <div class="bg-success text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                <span class="h4 mb-0">2</span>
            </div>
            <h5>Book & Pay</h5>
            <p class="text-muted">Secure your slot with our easy booking process and safe payment options</p>
        </div>
        <div class="col-md-4 text-center">
            <div class="bg-warning text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                <span class="h4 mb-0">3</span>
            </div>
            <h5>Play & Enjoy</h5>
            <p class="text-muted">Show up at your scheduled time and enjoy your game with friends</p>
        </div>
    </div>
</section>

<!-- AVAILABLE SLOTS SECTION -->
<section id="available-slots" class="container my-5">
    <h2 class="section-title">Available Slots</h2>

    <!-- Filter Bar -->
    <div class="filter-bar mb-4">
        <form class="row g-3 align-items-center" method="GET" action="{{ route('bookturf') }}">
            <div class="col-md-3">
                <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Search by turf name...">
            </div>
            <div class="col-md-2">
                <select class="form-select" name="sport">
                    <option value="">All Sports</option>
                    @foreach ($sportFilters as $sport)
                        <option value="{{ $sport }}" @selected(request('sport') === $sport)>{{ ucfirst($sport) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <select class="form-select" name="city">
                    <option value="">All Locations</option>
                    @foreach ($cityFilters as $city)
                        <option value="{{ $city }}" @selected(request('city') === $city)>{{ $city }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <input type="date" name="date" class="form-control" value="{{ $selectedDate }}">
            </div>
            <div class="col-md-2 text-end">
                <button class="btn btn-dark w-100">Search Slots</button>
            </div>
        </form>
    </div>

    <!-- Sort Options -->
    <div class="sort-options">
        <div class="d-flex flex-wrap justify-content-between align-items-center">
            <span class="text-muted">Showing {{ $turfs->count() }} turfs for {{ \Carbon\Carbon::parse($selectedDate)->format('d M Y') }}</span>
            <small class="text-muted">Choose a slot to book instantly.</small>
        </div>
    </div>

    @if (session('status'))
        <div class="alert alert-success mt-3">
            {{ session('status') }}
        </div>
    @endif

    @error('slot_id')
        <div class="alert alert-danger mt-3">
            {{ $message }}
        </div>
    @enderror

    <!-- Slots Cards -->
    <div class="row g-4">
        @forelse ($turfs as $turf)
            <div class="col-md-4">
                <div class="card field-card h-100">
                    <img src="{{ $turf->image_url ? (filter_var($turf->image_url, FILTER_VALIDATE_URL) ? $turf->image_url : asset('storage/' . $turf->image_url)) : 'https://via.placeholder.com/400x250?text=' . urlencode($turf->name) }}" 
                         class="card-img-top" 
                         alt="{{ $turf->name }}"
                         style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <span class="badge {{ $turf->slots->where('status', 'available')->count() ? 'badge-available' : 'badge-booked' }} mb-2">
                            {{ strtoupper($turf->sport_type) }}
                        </span>
                        <h6 class="fw-bold">{{ $turf->name }}</h6>
                        <p class="text-muted small mb-1">{{ $turf->location }}</p>
                        <p class="text-muted small mb-1"><i class="fas fa-map-marker-alt"></i> {{ $turf->city }}</p>
                        <p class="field-price">₹{{ number_format($turf->base_price, 2) }} per hour</p>

                        <h6 class="mt-3">Slots on {{ \Carbon\Carbon::parse($selectedDate)->format('d M, Y') }}</h6>

                        @forelse ($turf->slots as $slot)
                            @php
                                $isBooked = $slot->bookings->where('status', '!=', 'cancelled')->isNotEmpty();
                                $slotAvailable = !$isBooked && $slot->status === 'available';
                                $startTime = is_string($slot->start_time) ? $slot->start_time : date('H:i', strtotime($slot->start_time));
                                $endTime = is_string($slot->end_time) ? $slot->end_time : date('H:i', strtotime($slot->end_time));
                            @endphp
                            <div class="border rounded p-2 mb-2 d-flex justify-content-between align-items-center">
                                <div>
                                    <p class="mb-0 small">
                                        <i class="fas fa-clock"></i>
                                        {{ $startTime }} - {{ $endTime }}
                                    </p>
                                    <small class="text-muted">₹{{ number_format($slot->price, 2) }}</small>
                                </div>
                                @if ($slotAvailable)
                                    @auth
                                        @if (auth()->user()->role === 'user')
                                            <button class="btn btn-success btn-sm" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#bookingModal"
                                                    data-slot-id="{{ $slot->id }}"
                                                    data-turf-id="{{ $turf->id }}"
                                                    data-turf-name="{{ $turf->name }}"
                                                    data-turf-location="{{ $turf->location }}, {{ $turf->city }}"
                                                    data-turf-image="{{ $turf->image_url ? (filter_var($turf->image_url, FILTER_VALIDATE_URL) ? $turf->image_url : asset('storage/' . $turf->image_url)) : 'https://via.placeholder.com/400x250?text=' . urlencode($turf->name) }}"
                                                    data-slot-time="{{ $startTime }} - {{ $endTime }}"
                                                    data-slot-date="{{ $slot->date->format('Y-m-d') }}"
                                                    data-slot-price="{{ $slot->price }}">
                                                Book Now
                                            </button>
                                        @else
                                            <span class="badge bg-warning text-dark">Login as user to book</span>
                                        @endif
                                    @else
                                        <a href="{{ route('users.login') }}" class="btn btn-outline-success btn-sm">Login to Book</a>
                                    @endauth
                                @else
                                    <span class="badge badge-booked">Booked</span>
                                @endif
                            </div>
                        @empty
                            <p class="text-muted small">No slots for this date. Try another date.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info">
                    No turfs available for your filters. Try adjusting your search.
                </div>
            </div>
        @endforelse
    </div>
</section>


<!-- TESTIMONIALS SECTION -->
<section class="container my-5">
    <h2 class="section-title">What Our Customers Say</h2>
    <div class="row">
        <div class="col-md-4">
            <div class="testimonial-card">
                <div class="card-rating mb-3">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <p class="testimonial-text">"Booking through TurfBooker is so convenient! Found a great football field near my place and booked it in minutes."</p>
                <p class="testimonial-author">- Rahul Sharma</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="testimonial-card">
                <div class="card-rating mb-3">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <p class="testimonial-text">"The variety of sports facilities available is impressive. I've booked cricket nets, football fields, and even badminton courts!"</p>
                <p class="testimonial-author">- Priya Patel</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="testimonial-card">
                <div class="card-rating mb-3">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <p class="testimonial-text">"Customer support is excellent. Had to reschedule my booking once and they handled it smoothly without any hassle."</p>
                <p class="testimonial-author">- Ankit Verma</p>
            </div>
        </div>
    </div>
</section>

<!-- LOCATIONS SECTION -->
<section class="container my-5">
    <h2 class="section-title">Popular Locations</h2>
    <div class="row g-4">
        <div class="col-md-4">
            <div class="location-card">
                <img src="https://images.unsplash.com/photo-1580273916550-e323be2ae537?ixlib=rb-4.1.0&auto=format&fit=crop&q=80&w=800" class="card-img-top" alt="North City" style="height: 150px; object-fit: cover;">
                <div class="card-body">
                    <h5 class="card-title">North City</h5>
                    <p class="card-text">15+ turf venues available</p>
                    <a href="#" class="btn btn-outline-dark btn-sm">Explore Venues</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="location-card">
                <img src="https://images.unsplash.com/photo-1477959858617-67f85cf4f1df?ixlib=rb-4.1.0&auto=format&fit=crop&q=80&w=800" class="card-img-top" alt="South City" style="height: 150px; object-fit: cover;">
                <div class="card-body">
                    <h5 class="card-title">South City</h5>
                    <p class="card-text">12+ turf venues available</p>
                    <a href="#" class="btn btn-outline-dark btn-sm">Explore Venues</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="location-card">
                <img src="https://images.unsplash.com/photo-1449824913935-59a10b8d2000?ixlib=rb-4.1.0&auto=format&fit=crop&q=80&w=800" class="card-img-top" alt="East City" style="height: 150px; object-fit: cover;">
                <div class="card-body">
                    <h5 class="card-title">East City</h5>
                    <p class="card-text">18+ turf venues available</p>
                    <a href="#" class="btn btn-outline-dark btn-sm">Explore Venues</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- NEWSLETTER SECTION -->
<section class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            <div class="bg-light p-5 rounded-3">
                <h3 class="mb-3">Stay Updated</h3>
                <p class="text-muted mb-4">Subscribe to our newsletter to get updates on new venues, special offers, and sports events.</p>
                <div class="input-group mb-3">
                    <input type="email" class="form-control" placeholder="Enter your email">
                    <button class="btn btn-success" type="button">Subscribe</button>
                </div>
                <small class="text-muted">We respect your privacy. Unsubscribe at any time.</small>
            </div>
        </div>
    </div>
</section>

<!-- Booking Modal -->
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

<!-- FOOTER -->
<section>
    @include('pages.footer')
</section>

<script>
    // Simple script for active state on sort buttons
    document.addEventListener('DOMContentLoaded', function() {
        const sortButtons = document.querySelectorAll('.btn-group .btn');
        sortButtons.forEach(button => {
            button.addEventListener('click', function() {
                sortButtons.forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');
            });
        });
    });
</script>

@endsection