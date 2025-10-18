@extends('layouts.master_navbar')

@section('content')
    <!-- ====== ABOUT US PAGE ====== -->

    <!-- Banner Section -->
    <section class="about-banner position-relative d-flex align-items-center justify-content-center text-center"
        style="height: 45vh; background: linear-gradient(rgba(0, 0, 0, 0.45), rgba(0, 0, 0, 0.45)), url('https://images.unsplash.com/photo-1664829879065-7c20cb1aa032?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&q=80&w=1528') center/cover no-repeat;">
        <div class="text-white">
            <h1 class="fw-bold display-5">About TurfBook</h1>
            <p class="lead mt-2">Connecting players, owners, and passion — one turf at a time</p>
        </div>
    </section>

    <!-- Main About Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row align-items-center g-5 rounded-lg">
                <div class="col-md-6">
                    <img src="https://images.unsplash.com/photo-1599204606395-ede983387d21?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&q=80&w=870"
                        class="img-fluid rounded-3 shadow-sm w-full" alt="About TurfBook">
                </div>

                <div class="col-md-6">
                    <h5 class="fw-bold mb-3 text-dark">About</h5>
                    <p class="text-gray small">
                        <strong>TurfBook.com</strong> is the premier destination for sports enthusiasts, turf owners,
                        and teams seeking the best sports facilities in their area.
                        We make turf booking seamless, transparent, and available anytime, anywhere.
                    </p>

                    <p class="text-gray small mb-4">
                        Whether you're a football fan organizing a weekend match, a turf owner managing your slots,
                        or a coach booking training sessions — TurfBook simplifies the entire process
                        with modern technology and real-time availability.
                    </p>

                    <a href="{{route('contactus')}}" class="btn btn-success rounded-pill px-4 py-2">
                        Contact Us
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Mission Section -->
    <section class="py-5">
        <div class="container text-center">
            <h2 class="fw-bold mb-4 text-dark">Our Mission</h2>
            <p class="text-gray col-md-8 mx-auto">
                At TurfBook, our mission is to empower the sports community by providing a
                hassle-free platform where players can discover and book their favorite
                turfs instantly, and turf owners can manage their facilities efficiently.
                We aim to bridge the gap between passion and play.
            </p>
        </div>
    </section>

    <!-- What We Offer Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="fw-bold text-center mb-5 text-dark">What We Offer</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100 text-center p-4">
                        <i class="bi bi-calendar-check display-5 text-success mb-3"></i>
                        <h5 class="fw-bold">Easy Turf Booking</h5>
                        <p class="text-gray small mb-0">Book your favorite turf instantly with just a few clicks —
                            anytime, anywhere.</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100 text-center p-4">
                        <i class="bi bi-people-fill display-5 text-success mb-3"></i>
                        <h5 class="fw-bold">Team & Player Management</h5>
                        <p class="text-gray small mb-0">Create teams, invite players, and organize matches effortlessly
                            through our system.</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100 text-center p-4">
                        <i class="bi bi-geo-alt-fill display-5 text-success mb-3"></i>
                        <h5 class="fw-bold">Location-Based Search</h5>
                        <p class="text-gray small mb-0">Find the nearest available turf around you using our smart location
                            feature.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Us Section -->
    <!-- Why Choose Us Section -->
    <section class="py-5 bg-light mt-5">
        <div class="container">
            <h2 class="fw-bold mb-5 text-center text-dark">Why Choose TurfBook?</h2>
            <div class="row g-4 justify-content-center text-center">

                <div class="col-12 col-md-3">
                    <i class="bi bi-check-circle-fill text-success display-5 mb-3"></i>
                    <h5 class="fw-bold mb-2">User-Friendly Booking</h5>
                    <p class="text-gray small mb-0">Simple and intuitive booking experience for players and teams.</p>
                </div>

                <div class="col-12 col-md-3">
                    <i class="bi bi-check-circle-fill text-success display-5 mb-3"></i>
                    <h5 class="fw-bold mb-2">Verified Listings</h5>
                    <p class="text-gray small mb-0">All turfs are verified with transparent pricing and availability.</p>
                </div>

                <div class="col-12 col-md-3">
                    <i class="bi bi-check-circle-fill text-success display-5 mb-3"></i>
                    <h5 class="fw-bold mb-2">Real-Time Updates</h5>
                    <p class="text-gray small mb-0">Get instant updates on turf availability and booking confirmations.</p>
                </div>

                <div class="col-12 col-md-3">
                    <i class="bi bi-check-circle-fill text-success display-5 mb-3"></i>
                    <h5 class="fw-bold mb-2">Dedicated Support</h5>
                    <p class="text-gray small mb-0">Our team is always ready to help players and turf owners alike.</p>
                </div>

            </div>
        </div>
    </section>


    <!-- Join the Community -->
    <section class="py-5 bg-success text-white text-center">
        <div class="container">
            <h2 class="fw-bold mb-3">Join the TurfBook Community Today!</h2>
            <p class="mb-4">Sign up to discover, book, and play at the best sports turfs near you.</p>
            <a href="/register" class="btn btn-light text-success fw-semibold px-4 py-2 rounded-pill">Get Started</a>
        </div>
    </section>

    <section>
<!-- Include footer -->
    @include('pages.footer')
</section>
@endsection
