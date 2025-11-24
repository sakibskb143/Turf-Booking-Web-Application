<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | TurfBook</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(160deg, #e9f9ee 0%, #eaf3ff 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Inter', sans-serif;
        }

        .login-card {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 6px 20px rgba(0,0,0,0.08);
            padding: 2rem 1.8rem;
            width: 100%;
            max-width: 360px;
            text-align: center;
        }

        .brand-logo {
            background-color: #00b050;
            color: #fff;
            font-weight: 700;
            font-size: 22px;
            border-radius: 10px;
            display: inline-block;
            width: 50px;
            height: 50px;
            line-height: 50px;
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

        .btn-login {
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

        .btn-login:hover {
            background-color: #029545;
        }

        .text-muted {
            font-size: 0.85rem;
        }

        .login-footer {
            margin-top: 1rem;
            font-size: 0.85rem;
        }

        .login-footer a {
            color: #00b050;
            font-weight: 600;
            text-decoration: none;
        }

        .login-footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="login-card">
        <div class="brand-logo">TB</div>
        <h5 class="fw-bold mb-2">Admin Login</h5>
        <p class="text-muted mb-4">Access your TurfBook admin panel</p>

        @if (session('status'))
            <div class="alert alert-success text-start small">
                {{ session('status') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger text-start small">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.authenticate') }}">
            @csrf
            <div class="mb-3 text-start">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="Enter your admin email" required>
            </div>

            <div class="mb-4 text-start">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password" required>
            </div>

            <button type="submit" class="btn-login">Login</button>
        </form>

        <div class="login-footer">
            <a href="{{ url('/') }}">← Back to Home</a>
        </div>
    </div>
</body>
</html>
