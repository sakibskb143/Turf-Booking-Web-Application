@extends('layouts.master_navbar')

@section('content')
<style>
    /* ===== HERO SECTION ===== */
    .hero-section {
        position: relative;
        width: 100%;
        height: 100vh;
        background: 
            linear-gradient(rgba(0, 0, 0, 0.45), rgba(0, 0, 0, 0.45)),
            url('https://images.unsplash.com/photo-1550881111-7cfde14b8073?ixlib=rb-4.1.0&auto=format&fit=crop&q=80&w=870');
        background-size: cover;
        background-position: center;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        border-radius: 12px;
    }

    .hero-title {
        font-weight: 700;
        font-size: 3rem;
    }

    .hero-title span {
        color: #22c55e;
    }

    .hero-text {
        max-width: 650px;
        margin: 1rem auto 2rem;
        color: #e5e7eb;
        font-size: 1.05rem;
    }

    .btn-success {
        background-color: #16a34a;
        border: none;
        font-weight: 500;
    }

    .btn-success:hover {
        background-color: #15803d;
    }

    .btn-outline-light {
        border: 1.5px solid #f3f4f6;
        color: #f3f4f6;
        font-weight: 500;
    }

    .btn-outline-light:hover {
        background-color: #f3f4f6;
        color: #111827;
    }

    @media (max-width: 768px) {
        .hero-title {
            font-size: 2.2rem;
        }
    }

    /* ===== CATEGORY & FIELD SECTION ===== */
    .section-title {
        text-align: center;
        font-weight: 700;
        color: #111827;
        margin-top: 4rem;
        margin-bottom: 2rem;
    }

    .category-card, .field-card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        transition: transform 0.2s ease;
    }

    .category-card:hover, .field-card:hover {
        transform: translateY(-5px);
    }

    .category-card img, .field-card img {
        border-radius: 15px 15px 0 0;
        height: 180px;
        object-fit: cover;
    }

    .filter-bar {
        background: #f8fafc;
        padding: 1.5rem;
        border-radius: 12px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.05);
        margin-bottom: 2rem;
    }

    /* ===== WHY CHOOSE & GET STARTED ===== */
    .stats-section {
        background: linear-gradient(to right, #f8fafc, #f0fdf4);
        border-radius: 12px;
        padding: 3rem 0;
        margin-top: 5rem;
    }

    .stats-section h3 {
        font-weight: 700;
        margin-bottom: 2rem;
    }

    .ready-section {
        background: white;
        border-radius: 12px;
        padding: 3rem 0;
        margin-top: 3rem;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    }
</style>

<!-- HERO SECTION -->
<div class="hero-section">
    <div class="content px-3">
        <h1 class="hero-title">Welcome to <span>TurfBook</span></h1>
        <p class="hero-text">
            Your complete turf booking and management solution. Book sports facilities, manage your business,
            or oversee the entire platform effortlessly.
        </p>
        <div>
            <a href="#" class="btn btn-success px-4 py-2 me-2">Get Started</a>
            <a href="{{route('users.signup')}}" class="btn btn-outline-light px-4 py-2">Sign In</a>
        </div>
    </div>
</div>

<!-- CATEGORIES SECTION -->
<section class="container my-5">
    <h2 class="section-title">Explore Categories</h2>
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card category-card">
                <img src="https://images.unsplash.com/photo-1607414721186-5309963d7b52?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&q=80&w=436" class="card-img-top" alt="Football">
                <div class="card-body text-center">
                    <h5 class="card-title fw-bold">Football</h5>
                    <p class="text-muted">Book premium football fields and practice grounds.</p>
                    <a href="#" class="btn btn-success btn-sm">View Fields</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card category-card">
                <img src="https://images.unsplash.com/photo-1671209151455-86980f5bf293?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&q=80&w=435" alt="Cricket">
                <div class="card-body text-center">
                    <h5 class="card-title fw-bold">Cricket</h5>
                    <p class="text-muted">Rent quality turfs and nets for cricket practice or matches.</p>
                    <a href="#" class="btn btn-success btn-sm">View Fields</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card category-card">
                <img src="https://images.unsplash.com/photo-1615294295454-1f3dcdc86468?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&q=80&w=1032" class="card-img-top" alt="Tennis">
                <div class="card-body text-center">
                    <h5 class="card-title fw-bold">Tennis</h5>
                    <p class="text-muted">Find professional tennis courts in your area.</p>
                    <a href="#" class="btn btn-success btn-sm">View Fields</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FIELDS SECTION -->
<section class="container my-5">
    <h2 class="section-title">Available Fields</h2>

    <!-- Filter Bar -->
    <div class="filter-bar mb-4">
        <div class="row g-3 align-items-center">
            <div class="col-md-4">
                <input type="text" class="form-control" placeholder="Search by field name...">
            </div>
            <div class="col-md-4">
                <select class="form-select">
                    <option selected>Filter by Category</option>
                    <option value="football">Football</option>
                    <option value="cricket">Cricket</option>
                    <option value="tennis">Tennis</option>
                </select>
            </div>
            <div class="col-md-4">
                <select class="form-select">
                    <option selected>Filter by Status</option>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                    <option value="maintenance">Maintenance</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Field Cards -->
    <div class="row g-4">
        <div class="col-md-3">
            <div class="card field-card">
                <img src="https://images.unsplash.com/photo-1671209151455-86980f5bf293?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&q=80&w=435" class="card-img-top" alt="Field 1">
                <div class="card-body text-center">
                    <h6 class="fw-bold">Green Turf - A</h6>
                    <p class="text-muted small mb-2">Status: Active</p>
                    <a href="#" class="btn btn-outline-success btn-sm">Book Now</a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card field-card">
                <img src="https://images.unsplash.com/photo-1671209151455-86980f5bf293?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&q=80&w=435" class="card-img-top" alt="Field 2">
                <div class="card-body text-center">
                    <h6 class="fw-bold">Elite Turf - B</h6>
                    <p class="text-muted small mb-2">Status: Maintenance</p>
                    <a href="#" class="btn btn-outline-success btn-sm disabled">Unavailable</a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card field-card">
                <img src="https://images.unsplash.com/photo-1671209151455-86980f5bf293?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&q=80&w=435" class="card-img-top" alt="Field 3">
                <div class="card-body text-center">
                    <h6 class="fw-bold">Sunset Field - C</h6>
                    <p class="text-muted small mb-2">Status: Active</p>
                    <a href="#" class="btn btn-outline-success btn-sm">Book Now</a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card field-card">
                <img src="https://images.unsplash.com/photo-1671209151455-86980f5bf293?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&q=80&w=435" class="card-img-top" alt="Field 4">
                <div class="card-body text-center">
                    <h6 class="fw-bold">Skyline Arena - D</h6>
                    <p class="text-muted small mb-2">Status: Inactive</p>
                    <a href="#" class="btn btn-outline-success btn-sm disabled">Unavailable</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- WHY CHOOSE TURFBOOK -->
<section class="container stats-section text-center">
    <h3>Why Choose TurfBook?</h3>
    <div class="row justify-content-center">
        <div class="col-md-3">
            <h2 class="text-success fw-bold">500+</h2>
            <p>Active Turfs</p>
        </div>
        <div class="col-md-3">
            <h2 class="text-primary fw-bold">10K+</h2>
            <p>Happy Players</p>
        </div>
        <div class="col-md-3">
            <h2 class="fw-bold" style="color: purple;">50K+</h2>
            <p>Bookings Made</p>
        </div>
        <div class="col-md-3">
            <h2 class="text-danger fw-bold">24/7</h2>
            <p>Support Available</p>
        </div>
    </div>
</section>

<!-- READY TO GET STARTED -->
<section class="container ready-section text-center my-5">
    <h3 class="fw-bold mb-3">Ready to Get Started?</h3>
    <p class="text-muted mb-4">Join thousands of players and turf owners who trust TurfBook for their sports facility booking needs.</p>
    <a href="{{route('users.signup')}}" class="btn btn-success px-4 me-2">Create Account</a>
    <a href="#" class="btn btn-outline-dark px-4">Browse Turfs</a>
</section>

<section>
<!-- Include footer -->
    @include('pages.footer')
</section>


@endsection
