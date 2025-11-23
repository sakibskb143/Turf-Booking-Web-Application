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

                    <a href="{{ url('booking-system/football') }}" class="btn btn-success btn-sm">
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

                    <a href="{{ url('booking-system/cricket') }}" class="btn btn-success btn-sm">
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

                    <a href="{{ url('booking-system/tennis') }}" class="btn btn-success btn-sm">
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
        <div class="row g-3 align-items-center">
            <div class="col-md-3">
                <input type="text" class="form-control" placeholder="Search by field name...">
            </div>
            <div class="col-md-2">
                <select class="form-select">
                    <option selected>All Categories</option>
                    <option value="football">Football</option>
                    <option value="cricket">Cricket</option>
                    <option value="tennis">Tennis</option>
                    <option value="badminton">Badminton</option>
                    <option value="basketball">Basketball</option>
                </select>
            </div>
            <div class="col-md-2">
                <select class="form-select">
                    <option selected>All Locations</option>
                    <option value="north">North City</option>
                    <option value="south">South City</option>
                    <option value="east">East City</option>
                    <option value="west">West City</option>
                </select>
            </div>
            <div class="col-md-3">
                <input type="date" class="form-control" value="{{ date('Y-m-d') }}">
            </div>
            <div class="col-md-2 text-end">
                <button class="btn btn-dark">Search Slots</button>
            </div>
        </div>
    </div>

    <!-- Sort Options -->
    <div class="sort-options">
        <div class="row align-items-center">
            <div class="col-md-6">
                <span class="text-muted">Showing 12 available slots</span>
            </div>
            <div class="col-md-6 text-end">
                <span class="me-2">Sort by:</span>
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-outline-dark btn-sm active">Price</button>
                    <button type="button" class="btn btn-outline-dark btn-sm">Rating</button>
                    <button type="button" class="btn btn-outline-dark btn-sm">Distance</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Slots Cards -->
    <div class="row g-4">
        <div class="col-md-3">
            <div class="card field-card">
                <div class="card-body">
                    <span class="badge badge-popular mb-2">Popular</span>
                    <h6 class="fw-bold">Green Valley Football Field A</h6>
                    <p class="text-muted small mb-1">Green Valley Sports Complex</p>
                    <p class="text-muted small mb-1"><i class="fas fa-map-marker-alt"></i> 2.3 km away</p>
                    <div class="card-rating mb-2">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                        <span class="text-muted">(24 reviews)</span>
                    </div>
                    <p class="text-muted small mb-1">{{ date('Y-m-d') }} | 06:00 - 07:00</p>
                    <p class="text-muted small mb-1">Capacity: 22 players</p>
                    <div class="card-amenities mb-2">
                        <span class="me-2"><i class="fas fa-shower amenity-icon"></i>Showers</span>
                        <span><i class="fas fa-car amenity-icon"></i>Parking</span>
                    </div>
                    <p class="field-price">₹1200 per hour <span class="badge badge-available float-end">Available</span></p>
                    <a href="#" class="btn btn-dark btn-sm btn-book w-100">Book Now</a>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card field-card">
                <div class="card-body">
                    <h6 class="fw-bold">Green Valley Football Field A</h6>
                    <p class="text-muted small mb-1">Green Valley Sports Complex</p>
                    <p class="text-muted small mb-1"><i class="fas fa-map-marker-alt"></i> 2.3 km away</p>
                    <div class="card-rating mb-2">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="far fa-star"></i>
                        <span class="text-muted">(24 reviews)</span>
                    </div>
                    <p class="text-muted small mb-1">{{ date('Y-m-d') }} | 18:00 - 19:00</p>
                    <p class="text-muted small mb-1">Capacity: 22 players</p>
                    <div class="card-amenities mb-2">
                        <span class="me-2"><i class="fas fa-shower amenity-icon"></i>Showers</span>
                        <span><i class="fas fa-car amenity-icon"></i>Parking</span>
                    </div>
                    <p class="field-price">₹1500 per hour <span class="badge badge-available float-end">Available</span></p>
                    <a href="#" class="btn btn-dark btn-sm btn-book w-100">Book Now</a>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card field-card">
                <div class="card-body">
                    <h6 class="fw-bold">Green Valley Football Field B</h6>
                    <p class="text-muted small mb-1">Green Valley Sports Complex</p>
                    <p class="text-muted small mb-1"><i class="fas fa-map-marker-alt"></i> 2.5 km away</p>
                    <div class="card-rating mb-2">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <span class="text-muted">(32 reviews)</span>
                    </div>
                    <p class="text-muted small mb-1">{{ date('Y-m-d') }} | 19:00 - 20:00</p>
                    <p class="text-muted small mb-1">Capacity: 22 players</p>
                    <div class="card-amenities mb-2">
                        <span class="me-2"><i class="fas fa-shower amenity-icon"></i>Showers</span>
                        <span><i class="fas fa-car amenity-icon"></i>Parking</span>
                    </div>
                    <p class="field-price">₹1400 per hour <span class="badge badge-available float-end">Available</span></p>
                    <a href="#" class="btn btn-dark btn-sm btn-book w-100">Book Now</a>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card field-card">
                <div class="card-body">
                    <span class="badge badge-popular mb-2">Popular</span>
                    <h6 class="fw-bold">City Cricket Ground</h6>
                    <p class="text-muted small mb-1">City Sports Center</p>
                    <p class="text-muted small mb-1"><i class="fas fa-map-marker-alt"></i> 1.8 km away</p>
                    <div class="card-rating mb-2">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="far fa-star"></i>
                        <span class="text-muted">(18 reviews)</span>
                    </div>
                    <p class="text-muted small mb-1">{{ date('Y-m-d', strtotime('+1 day')) }} | 16:00 - 18:00</p>
                    <p class="text-muted small mb-1">Capacity: 30 players</p>
                    <div class="card-amenities mb-2">
                        <span class="me-2"><i class="fas fa-shower amenity-icon"></i>Showers</span>
                        <span><i class="fas fa-utensils amenity-icon"></i>Cafeteria</span>
                    </div>
                    <p class="field-price">₹2000 per hour <span class="badge badge-available float-end">Available</span></p>
                    <a href="#" class="btn btn-dark btn-sm btn-book w-100">Book Now</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Load More Button -->
    <div class="text-center mt-5">
        <button class="btn btn-outline-dark">Load More Slots</button>
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