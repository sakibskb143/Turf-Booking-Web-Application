<?php

namespace App\Http\Controllers;

use App\Models\UserNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    public function dashboard(Request $request)
    {
        $user = $request->user();

        $totalBookings = $user->bookings()->count();
        $thisMonthBookings = $user->bookings()
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();
        $amountSpent = $user->bookings()->sum('total_amount');

        $recentBookings = $user->bookings()
            ->with(['slot', 'turf'])
            ->latest()
            ->take(5)
            ->get();

        $notifications = $user->userNotifications()
            ->latest()
            ->take(5)
            ->get();

        return view('user_dashboard.dashboard', [
            'user' => $user,
            'totalBookings' => $totalBookings,
            'thisMonthBookings' => $thisMonthBookings,
            'amountSpent' => $amountSpent,
            'recentBookings' => $recentBookings,
            'notifications' => $notifications,
        ]);
    }

    public function bookings(Request $request)
    {
        $user = $request->user();

        $bookings = $user->bookings()
            ->with(['slot', 'turf'])
            ->latest()
            ->paginate(10);

        $totalBookings = $user->bookings()->count();
        $completed = $user->bookings()->where('status', 'confirmed')->count();
        $totalSpent = $user->bookings()->sum('total_amount');

        return view('user_dashboard.bookings', [
            'bookings' => $bookings,
            'totalBookings' => $totalBookings,
            'completedBookings' => $completed,
            'totalSpent' => $totalSpent,
        ]);
    }

    public function notifications(Request $request)
    {
        $notifications = $request->user()->userNotifications()->latest()->paginate(10);

        return view('user_dashboard.notifications', [
            'notifications' => $notifications,
        ]);
    }

    public function profile(Request $request)
    {
        return view('user_dashboard.profile', [
            'user' => $request->user(),
        ]);
    }
}

