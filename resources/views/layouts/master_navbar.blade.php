<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>TurfBook</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Font: Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">



    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.25rem;
        }

        .brand-logo {
            background-color: #16a34a;
            color: #fff;
            font-weight: 700;
            border-radius: 8px;
            padding: 6px 10px;
            margin-right: 8px;
            display: inline-block;
        }

        .nav-link {
            font-weight: 500;
            color: #374151 !important;
            margin-right: 15px;
        }

        .nav-link:hover {
            color: #16a34a !important;
        }

        .avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            object-fit: cover;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm py-2">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <span class="brand-logo">TB</span>
                TurfBook
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('bookturf')}}">Book Turf</a></li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('aboutus') }}">About Us</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('contactus') }}">Contact Us</a>
                    </li>

                </ul>
            </div>

            @php
                $user = auth()->user();
                $dashboardRoute = $user? match ($user->role) {
                    'admin' => route('admin.dashboard'),
                    'owner' => route('owner.dashboard'),
                    default => route('user.dashboard'),
                } : null;
                $avatarUrl = $user?->profile_image
                    ? asset('storage/' . ltrim($user->profile_image, '/'))
                    : ($user ? 'https://ui-avatars.com/api/?background=16a34a&color=fff&name=' . urlencode($user->name) : null);
            @endphp

            <div class="d-flex align-items-center">
                <ul class="navbar-nav align-items-center">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('users.login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('users.signup') }}">Signup</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('owners.login') }}">Owner Login</a>
                        </li>
                    @endguest

                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ $dashboardRoute }}">{{ ucfirst(auth()->user()->role) }} Dashboard</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="{{ $avatarUrl }}" alt="avatar" class="avatar me-2">
                                <span>{{ $user->name }}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                                <li class="px-3 py-2">
                                    <div class="fw-semibold">{{ $user->name }}</div>
                                    <div class="text-muted small">{{ $user->email }}</div>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button class="dropdown-item text-danger" type="submit">
                                            <i class="bi bi-box-arrow-right me-2"></i>Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endauth
                </ul>
            </div>

        </div>
    </nav>

    <!-- Page Content -->
    <div class="container mt-4">
        @yield('content')
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
