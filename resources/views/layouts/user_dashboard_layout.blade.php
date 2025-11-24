<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Dashboard - TurfBook</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f9fafb;
        }

        .sidebar {
            height: 100vh;
            background: white;
            width: 240px;
            position: fixed;
            border-right: 1px solid #e5e7eb;
            padding-top: 20px;
        }

        .sidebar a {
            display: block;
            padding: 12px 20px;
            color: #374151;
            font-weight: 500;
            text-decoration: none;
            margin-bottom: 5px;
        }

        .sidebar a:hover {
            background: #16a34a;
            color: white;
            border-radius: 8px;
        }

        .active-link {
            background: #16a34a;
            color: white !important;
            border-radius: 8px;
        }

        .dashboard-content {
            margin-left: 260px;
            padding: 25px;
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
    </style>
</head>

<body>
 
    <!-- SIDEBAR -->
    <div class="sidebar">
       <div class="d-flex align-items-center">
    <a class="navbar-brand d-flex align-items-center text-center" href="#">
        <span class="brand-logo">TB</span>
        TurfBook
    </a>
</div>

       

      

        <a href="{{ route('user.dashboard') }}" class="{{ request()->is('user/dashboard') ? 'active-link' : '' }}">
            <i class="bi bi-speedometer2 me-2"></i> Dashboard
        </a>

      
        <a href="{{ route('user.bookings') }}" class="{{ request()->is('user/bookings') ? 'active-link' : '' }}">
            <i class="bi bi-calendar-check me-2"></i> My Booking History
        </a>

        <a href="{{ route('user.notifications') }}" class="{{ request()->is('user/notifications') ? 'active-link' : '' }}">
            <i class="bi bi-bell me-2"></i> Notifications
        </a>

        <a href="{{ route('user.profile') }}" class="{{ request()->is('user/profile') ? 'active-link' : '' }}">
            <i class="bi bi-person-circle me-2"></i> Profile
        </a>

        <form method="POST" action="{{ route('logout') }}" class="px-3 mt-3">
            @csrf
            <button type="submit" class="btn btn-outline-danger w-100">
                <i class="bi bi-box-arrow-right me-2"></i> Logout
            </button>
        </form>
    </div>


    <!-- MAIN CONTENT -->
    <div class="dashboard-content">
        @yield('content')
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
