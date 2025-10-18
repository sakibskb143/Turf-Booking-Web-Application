<!-- FOOTER SECTION -->
<style>
    .footer-section {
        border-radius: 12px;
    }

    /* Gray text for readability on white background */
    .text-gray {
        color: #6c757d;
        transition: color 0.3s ease;
        text-decoration: none;
    }

    .text-gray:hover {
        color: #16a34a !important; /* green hover */
    }

    /* Icon hover effect */
    .bi {
        color: #6c757d;
        transition: all 0.2s ease;
    }

    .bi:hover {
        color: #16a34a;
        transform: scale(1.1);
    }
</style>

<footer class="bg-white pt-5 pb-3 mt-5 footer-section">
    <div class="container">
        <div class="row g-4">

            <!-- Seller Options -->
            <div class="col-md-2">
                <h5 class="fw-bold mb-3 text-dark">Seller Options</h5>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="{{route('owners.login')}}" class="text-gray">Login as Seller</a></li>
                    <li class="mb-2"><a href="{{route('owners.signup')}}" class="text-gray">Signup as Seller</a></li>
                </ul>
            </div>

            <!-- My Account -->
            <div class="col-md-2">
                <h5 class="fw-bold mb-3 text-dark">My Account</h5>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="#" class="text-gray">Login</a></li>
                    <li class="mb-2"><a href="#" class="text-gray">Create Account</a></li>
                </ul>
            </div>

            <!-- Useful Links -->
            <div class="col-md-3">
                <h5 class="fw-bold mb-3 text-dark">Useful Links</h5>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="#" class="text-gray">Latest News</a></li>
                    <li class="mb-2"><a href="#" class="text-gray">Browse All Games</a></li>
                    <li class="mb-2"><a href="#" class="text-gray">Terms & Conditions</a></li>
                    <li class="mb-2"><a href="#" class="text-gray">Privacy Policy</a></li>
                    <li class="mb-2"><a href="#" class="text-gray">Return Policy</a></li>
                    <li class="mb-2"><a href="#" class="text-gray">Cancellation Policy</a></li>
                    <li class="mb-2"><a href="#" class="text-gray">Refund Policy</a></li>
                </ul>
            </div>

            <!-- Contact Us -->
            <div class="col-md-3">
                <h5 class="fw-bold mb-3 text-dark">Contact Us</h5>
                <ul class="list-unstyled mb-0">
                    <li class="mb-3">
                        <p class="mb-1 fw-semibold text-dark">Address</p>
                        <p class="text-gray mb-0">
                            Chattogram Software Technology Park,<br>
                            Agrabad, Chattogram A000
                        </p>
                    </li>
                    <li class="mb-3">
                        <p class="mb-1 fw-semibold text-dark">Email</p>
                        <a href="mailto:info.TurfBook@gmail.com" class="text-gray">info.TurfBook@gmail.com</a>
                    </li>
                    <li>
                        <p class="mb-1 fw-semibold text-dark">Phone</p>
                        <a href="tel:+88088893902" class="text-gray">+88088893902</a>
                    </li>
                </ul>
            </div>

            <!-- About -->
            <div class="col-md-2">
                <h5 class="fw-bold mb-3 text-dark">About</h5>
                <p class="text-gray small">
                    TurfBook.com is the premier destination for sports fans, providing resources to keep you engaged from the first whistle to the final buzzer.
                </p>
                <div class="mt-3">
                    <a href="#" class="me-3"><i class="bi bi-facebook fs-5"></i></a>
                    <a href="#" class="me-3"><i class="bi bi-instagram fs-5"></i></a>
                    <a href="#" class="me-3"><i class="bi bi-twitter-x fs-5"></i></a>
                    <a href="#" class="me-3"><i class="bi bi-linkedin fs-5"></i></a>
                    <a href="#"><i class="bi bi-youtube fs-5"></i></a>
                </div>
            </div>
        </div>

        <!-- Bottom Nav -->
        <div class="row mt-4 pt-4 border-top border-secondary">
            <div class="col-12">
                <div class="d-flex flex-wrap justify-content-center">
                    <a href="#" class="text-gray mx-3 mb-2">Home</a>
                    <a href="#" class="text-gray mx-3 mb-2">All Categories</a>
                    <a href="#" class="text-gray mx-3 mb-2">All Turfs</a>
                    <a href="#" class="text-gray mx-3 mb-2">Blogs</a>
                    <a href="#" class="text-gray mx-3 mb-2">Campaigns</a>
                </div>
            </div>
        </div>

        <!-- Copyright -->
        <div class="row mt-3">
            <div class="col-12 text-center">
                <p class="text-gray mb-0">&copy; 2023 TurfBook. All rights reserved.</p>
            </div>
        </div>
    </div>
</footer>
