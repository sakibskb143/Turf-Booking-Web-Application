@extends('layouts.master_navbar')

@section('content')

<!-- 🌿 BANNER SECTION -->
<section class="text-white text-center rounded-3" 
    style="background: url('https://images.unsplash.com/photo-1632072835323-74659dd03a40?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTI2OXx8Zm9vdGJhbGwlMjBmaWVsZHxlbnwwfHwwfHx8MA%3D%3D&auto=format&fit=crop&q=60&w=500') center/cover no-repeat; 
           padding: 120px 0; position: relative; ">
    <div class="overlay position-absolute top-0 start-0 w-100 h-100" 
        style="background: rgba(0, 0, 0, 0.55); border-radius: 0 0 50px 50px;"></div>
    <div class="container position-relative">
        <h1 class="fw-bold display-5 mb-3">Contact TurfBook</h1>
        <p class="lead text-light">We’re here to help you with your turf booking or inquiries — just reach out to us!</p>
    </div>
</section>

<!-- 🧭 CONTACT INFO SECTION -->
<section class="py-5" style="background-color: #f8fff4;">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold text-dark">Get in Touch</h2>
            <p class="text-muted">Reach us directly via email, phone, or by visiting our office.</p>
        </div>

        <div class="row g-4 justify-content-center">
            <!-- Address -->
            <div class="col-md-4 ">
                <div class="p-4 rounded-3 shadow-sm bg-white text-center h-100 border border-success-subtle hover-card">
                    <i class="bi bi-geo-alt-fill text-success display-5 mb-3"></i>
                    <h5 class="fw-bold">Address</h5>
                    <p class="text-muted small mb-0">
                        Chattogram Software Technology Park,<br>Agrabad, Chattogram A000
                    </p>
                </div>
            </div>

            <!-- Email -->
            <div class="col-md-4">
                <div class="p-4 rounded-3 shadow-sm bg-white text-center h-100 border border-success-subtle hover-card">
                    <i class="bi bi-envelope-fill text-success display-5 mb-3"></i>
                    <h5 class="fw-bold">Email</h5>
                    <p class="text-muted small mb-0">
                        <a href="mailto:info.TurfBook@gmail.com" class="text-decoration-none text-dark">info.TurfBook@gmail.com</a>
                    </p>
                </div>
            </div>

            <!-- Phone -->
            <div class="col-md-4">
                <div class="p-4 rounded-3 shadow-sm bg-white text-center h-100 border border-success-subtle hover-card">
                    <i class="bi bi-telephone-fill text-success display-5 mb-3"></i>
                    <h5 class="fw-bold">Phone</h5>
                    <p class="text-muted small mb-0">
                        <a href="tel:+88088893902" class="text-decoration-none text-dark">+880 8889 3902</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ✉️ CONTACT FORM SECTION -->
<section class="py-5" style="background: linear-gradient(135deg, #e8f5e9, #f8fff4);">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold text-dark">Send Us a Message</h2>
            <p class="text-muted">Have a question? We’ll get back to you within 24 hours.</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card border-0 shadow-lg rounded-4 p-4" 
                    style="background: #ffffff; border-top: 5px solid #28a745;">
                    <form>
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label text-success fw-semibold">Name</label>
                            <input type="text" id="name" class="form-control rounded-3 border-success-subtle" placeholder="Your name">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label text-success fw-semibold">Email</label>
                            <input type="email" id="email" class="form-control rounded-3 border-success-subtle" placeholder="Your email">
                        </div>
                        <div class="mb-3">
                            <label for="subject" class="form-label text-success fw-semibold">Subject</label>
                            <input type="text" id="subject" class="form-control rounded-3 border-success-subtle" placeholder="Subject">
                        </div>
                        <div class="mb-4">
                            <label for="message" class="form-label text-success fw-semibold">Message</label>
                            <textarea id="message" rows="4" class="form-control rounded-3 border-success-subtle" placeholder="Write your message..."></textarea>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-success rounded-3 px-5 py-2 shadow-sm btn-hover">
                                Send Message
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 📍 GOOGLE MAP & ADDRESS SECTION -->
<section class="py-5 position-relative" style="background-color: #f9f9f9;">
    <div class="container text-center mb-4">
        <h2 class="fw-bold text-dark mb-2">Find Us Here</h2>
        <p class="text-muted mb-4">Come visit our office at the heart of Chattogram’s tech district.</p>
    </div>

    <div class="container">
        <div class="rounded-4 overflow-hidden shadow-lg border border-success-subtle">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3651.865145792666!2d91.79207611501372!3d22.33719688520319!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30acd89f1c75edb9%3A0x7f3c9a6aa9a0d2d2!2sChattogram%20Software%20Technology%20Park!5e0!3m2!1sen!2sbd!4v1705677654321!5m2!1sen!2sbd"
                width="100%" height="400" style="border:0;" allowfullscreen loading="lazy">
            </iframe>
        </div>
    </div>
</section>

@include('pages.footer')

<style>
    /* Section spacing consistency */
    section {
        margin-bottom: 40px;
    }

    /* Hover card effect */
    .hover-card {
        transition: all 0.3s ease;
    }
    .hover-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        border-color: #28a745 !important;
    }

    /* Input focus */
    .form-control:focus {
        border-color: #28a745 !important;
        box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.2);
    }

    /* Button hover */
    .btn-hover {
        transition: all 0.3s ease;
    }
    .btn-hover:hover {
        background-color: #218838 !important;
        transform: scale(1.05);
    }
</style>

@endsection
