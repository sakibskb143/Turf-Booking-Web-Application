@extends('layouts.master_navbar')

@section('content')
<style>
    .signup-wrapper {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(160deg, #e9f9ee 0%, #eaf3ff 100%);
        padding: 2rem 1rem;
    }

    .signup-card {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 6px 20px rgba(0,0,0,0.08);
        padding: 2rem 1.8rem;
        width: 100%;
        max-width: 420px;
    }

    .brand-logo {
        background-color: #00b050;
        color: #fff;
        font-weight: 700;
        font-size: 20px;
        border-radius: 10px;
        display: inline-block;
        width: 48px;
        height: 48px;
        line-height: 48px;
        text-align: center;
        margin-bottom: 0.8rem;
    }

    .form-label {
        font-weight: 600;
        color: #333;
        font-size: 0.9rem;
    }

    .form-control {
        border-radius: 8px;
        padding: 0.7rem;
        border: 1px solid #dcdcdc;
        font-size: 0.9rem;
    }

    .form-control:focus {
        border-color: #00b050;
        box-shadow: 0 0 0 0.15rem rgba(0,176,80,0.15);
    }

    .btn-signup {
        background-color: #00b050;
        color: white;
        border-radius: 8px;
        padding: 0.7rem;
        font-weight: 600;
        font-size: 0.95rem;
        width: 100%;
        border: none;
        transition: 0.3s;
    }

    .btn-signup:hover {
        background-color: #029545;
    }

    .signup-footer {
        margin-top: 1rem;
        font-size: 0.85rem;
        text-align: center;
    }

    .signup-footer a {
        color: #00b050;
        font-weight: 600;
        text-decoration: none;
    }

    .signup-footer a:hover {
        text-decoration: underline;
    }
</style>

<div class="signup-wrapper">
    <div class="signup-card">
        <div class="text-center">
            <div class="brand-logo">TB</div>
            <h5 class="fw-bold mb-2">Create Admin Account</h5>
            <p class="text-muted mb-3">Manage the Turf Booking platform</p>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger small">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.register') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">Full Name</label>
                <input type="text" name="name" value="{{ old('name') }}" class="form-control" placeholder="Enter full name" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Email Address</label>
                <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="Enter email" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Phone</label>
                <input type="text" name="phone" value="{{ old('phone') }}" class="form-control" placeholder="Enter phone">
            </div>
            <div class="mb-3">
                <label class="form-label">Address</label>
                <input type="text" name="address" value="{{ old('address') }}" class="form-control" placeholder="Enter address">
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Create password" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm password" required>
            </div>

            <button type="submit" class="btn-signup">Sign Up</button>
        </form>

        <div class="signup-footer">
            <p>Already have an account? <a href="{{ route('admin.login') }}">Login</a></p>
            <a href="{{ url('/') }}">← Back to Home</a>
        </div>
    </div>
</div>
@endsection

