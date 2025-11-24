@extends('layouts.master_navbar')

@section('content')
    <style>
        body {
            background: linear-gradient(160deg, #f0fff4 0%, #e6f0ff 100%);
            font-family: 'Inter', sans-serif;
        }

        .auth-container {
            max-width: 600px;
            margin: 50px auto;
            background: #ffffff;
            padding: 2rem 2.5rem;
            border-radius: 20px;
            box-shadow: 0 6px 25px rgba(0, 0, 0, 0.08);
        }

        .auth-title {
            text-align: center;
            font-weight: 700;
            color: #006400;
            margin-bottom: 1rem;
        }

        .auth-subtitle {
            text-align: center;
            color: #666;
            margin-bottom: 2rem;
        }

        .form-label {
            font-weight: 600;
            color: #444;
        }

        .form-control {
            border-radius: 10px;
            padding: 0.75rem;
            border: 1px solid #dcdcdc;
        }

        .form-control:focus {
            border-color: #00b050;
            box-shadow: 0 0 0 0.15rem rgba(0, 176, 80, 0.15);
        }

        .password-toggle {
            position: relative;
        }

       

        .password-toggle .toggle-icon {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 18px;
            /* Smaller size */
            cursor: pointer;
            color: #666;
            transition: 0.2s ease;
        }

        .password-toggle .toggle-icon:hover {
            color: #00b050;
        }


        .btn-auth {
            background-color: #00b050;
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: 0.8rem;
            font-weight: 600;
            width: 100%;
            transition: 0.3s;
        }

        .btn-auth:hover {
            background-color: #029545;
        }

        .terms {
            margin-top: 1rem;
            font-size: 0.9rem;
            color: #555;
        }

        .auth-footer {
            text-align: center;
            margin-top: 1rem;
            font-size: 0.9rem;
        }

        .auth-footer a {
            color: #00b050;
            font-weight: 600;
            text-decoration: none;
        }

        .auth-footer a:hover {
            text-decoration: underline;
        }
    </style>

    <div class="container">
        <div class="auth-container">
            <h2 class="auth-title">Create Your Account</h2>
            <p class="auth-subtitle">Join us and start booking your turf today!</p>

            <form action="{{ route('users.register') }}" method="POST">
                @csrf

                @if ($errors->any())
                    <div class="alert alert-danger small">
                        {{ $errors->first() }}
                    </div>
                @endif

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control"
                            placeholder="Enter your full name" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Email Address</label>
                        <input type="email" name="email" value="{{ old('email') }}" class="form-control"
                            placeholder="Enter your email" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Phone</label>
                        <input type="text" name="phone" value="{{ old('phone') }}" class="form-control"
                            placeholder="Enter your phone number">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Address</label>
                        <input type="text" name="address" value="{{ old('address') }}" class="form-control"
                            placeholder="Enter your address">
                    </div>

                    <div class="col-12 password-toggle">
                        <label class="form-label">Password</label>
                        <div class="position-relative">
                            <input type="password" name="password" id="password" class="form-control pe-5"
                                placeholder="Create a password" required>
                            <i class="bi bi-eye toggle-icon" id="togglePassword"></i>
                        </div>
                    </div>

                    <div class="col-12 password-toggle">
                        <label class="form-label">Confirm Password</label>
                        <div class="position-relative">
                            <input type="password" name="password_confirmation" id="confirmPassword"
                                class="form-control pe-5" placeholder="Confirm your password" required>
                            <i class="bi bi-eye toggle-icon" id="toggleConfirmPassword"></i>
                        </div>
                    </div>


                    <div class="col-12 terms">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="terms" name="terms" required>
                            <label class="form-check-label" for="terms">
                                I agree to the <a href="#">terms and conditions</a> and the <a href="#">privacy
                                    policy</a> of Khelboo.
                            </label>
                        </div>
                    </div>

                    <div class="col-12 mt-3">
                        <button type="submit" class="btn-auth">Sign Up</button>
                    </div>
                </div>
            </form>

            <div class="auth-footer">
                <p>Already have an account? <a href="{{ route('users.login') }}">Login here</a></p>
            </div>
        </div>
    </div>

    <!-- Bootstrap Icons CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <script>
        // Toggle password visibility
        const togglePassword = document.getElementById('togglePassword');
        const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
        const password = document.getElementById('password');
        const confirmPassword = document.getElementById('confirmPassword');

        togglePassword.addEventListener('click', function() {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            this.classList.toggle('bi-eye-slash');
        });

        toggleConfirmPassword.addEventListener('click', function() {
            const type = confirmPassword.getAttribute('type') === 'password' ? 'text' : 'password';
            confirmPassword.setAttribute('type', type);
            this.classList.toggle('bi-eye-slash');
        });
    </script>
@endsection
