@extends('layouts.master_navbar')

@section('content')
    <style>
        body {
            background: linear-gradient(160deg, #f0fff4 0%, #e6f0ff 100%);
            font-family: 'Inter', sans-serif;
        }

        .auth-container {
            max-width: 400px;
            margin: 80px auto;
            background: #fff;
            padding: 2rem;
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
            {{-- <h2 class="auth-title">Owner Login</h2> --}}
            <h2 class="auth-title">Welcome Back!</h2>
            <p class="auth-subtitle">Login to continue to your dashboard</p>


            <form action="{{ route('owners.authenticate') }}" method="POST">
                @csrf

                @if (session('status'))
                    <div class="alert alert-success small">
                        {{ session('status') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger small">
                        {{ $errors->first() }}
                    </div>
                @endif

                <div class="mb-3">
                    <label class="form-label">Email Address</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="Enter your email" required>
                </div>

                <div class="mb-3 password-toggle">
                    <label class="form-label">Password</label>
                    <div class="position-relative">
                        <input type="password" name="password" id="password" class="form-control pe-5"
                            placeholder="Enter your password" required>
                        <i class="bi bi-eye toggle-icon" id="togglePassword"></i>
                    </div>
                </div>

                <div class="mb-3">
                    <button type="submit" class="btn-auth">Login</button>
                </div>
            </form>

            <div class="auth-footer">
                <p>Don't have an account? <a href="{{ route('owners.signup') }}">Sign Up here</a></p>
            </div>
        </div>
    </div>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <script>
        const togglePassword = document.getElementById('togglePassword');
        const password = document.getElementById('password');
        togglePassword.addEventListener('click', function() {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            this.classList.toggle('bi-eye-slash');
        });
    </script>
@endsection
