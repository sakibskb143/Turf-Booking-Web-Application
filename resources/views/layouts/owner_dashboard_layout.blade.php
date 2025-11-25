<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Owner Dashboard - TurfBook</title>

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
            transition: 0.3s;
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

        .brand-logo {
            background-color: #16a34a;
            color: #fff;
            font-weight: 700;
            border-radius: 8px;
            padding: 6px 10px;
            margin-right: 8px;
            display: inline-block;
        }

        .card-stats {
            border-radius: 12px;
            transition: 0.3s;
        }

        .card-stats:hover {
            transform: translateY(-4px);
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.12);
        }

        .status-badge {
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
        }

        .status-confirmed {
            background-color: #d1fae5;
            color: #065f46;
        }

        .status-pending {
            background-color: #fef3c7;
            color: #92400e;
        }
    </style>
</head>

<body>

    <!-- SIDEBAR -->
    <div class="sidebar">
        <div class="d-flex align-items-center mb-4 px-3">
            <span class="brand-logo">TB</span>
            <span class="fw-bold">TurfBook</span>
        </div>

        <a href="{{ route('owner.dashboard') }}" class="{{ Request::is('owner/dashboard') ? 'active-link' : '' }}">
            <i class="bi bi-speedometer2 me-2"></i> Dashboard
        </a>
        {{-- {{ route('owner.manageFields') }}" class="{{ Request::is('owner/manage-fields') ? 'active-link' : '' }} --}}
        <a href="{{ route('owner.manageTurf') }}">
    <i class="bi bi-collection me-2"></i> Manage Turfs
</a>

        {{-- {{ route('owner.manageSlots') }}" class="{{ Request::is('owner/manage-slots') ? 'active-link' : '' }} --}}
       <a href="{{ route('owner.manageSlots') }}" class="{{ Request::is('owner/manage-slots') ? 'active-link' : '' }}">
    <i class="bi bi-clock me-2"></i> Manage Slots
</a>

       <a href="{{ route('owner.bookings') }}" class="{{ Request::is('owner/bookings') ? 'active-link' : '' }}">
    <i class="bi bi-calendar-check me-2"></i> Bookings
</a>
       <a href="{{ route('owner.coupons') }}" class="{{ Request::is('owner/coupons') ? 'active-link' : '' }}">
    <i class="bi bi-bell me-2"></i> Coupons
</a>


        <a href="{{ route('owner.notifications') }}">
    <i class="bi bi-bell me-2"></i> Notifications
</a>

        <form method="POST" action="{{ route('logout') }}" class="px-3 mt-3">
            @csrf
            <button type="submit" class="btn btn-outline-danger w-100" style="border: none; background: none; color: inherit; text-align: left; padding: 10px 15px; width: 100%;">
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
