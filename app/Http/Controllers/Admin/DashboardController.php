<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tour;
use App\Models\Booking;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalTours       = Tour::count();
        $totalBookings    = Booking::count();
        $pendingBookings  = Booking::where('status', 'pending')->count();
        $completedBookings = Booking::where('status', 'done')->count();

        // Lấy 5 đơn đặt tour gần đây nhất
        $recentBookings = Booking::with('tour')
            ->latest()
            ->take(5)
            ->get();

        // Thống kê thêm (có thể mở rộng sau)
        $todayBookings = Booking::whereDate('created_at', Carbon::today())->count();
        $thisMonthBookings = Booking::whereMonth('created_at', Carbon::now()->month)
                                    ->whereYear('created_at', Carbon::now()->year)
                                    ->count();

        return view('admin.dashboard', compact(
            'totalTours',
            'totalBookings',
            'pendingBookings',
            'completedBookings',
            'recentBookings',
            'todayBookings',
            'thisMonthBookings'
        ));
    }
}