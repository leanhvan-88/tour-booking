<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tour;
use App\Models\Booking;

class BookingController extends Controller
{
    /**
     * Form đặt tour
     */
    public function create($tourId)
    {
        $tour = Tour::findOrFail($tourId);

        return view('user.booking.create', compact('tour'));
    }

    /**
     * Lưu booking
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'tour_id' => 'required|exists:tours,id',
            'full_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email',

            'adult_count' => 'nullable|integer|min:1',
            'child_count' => 'nullable|integer|min:0',
            'departure_date' => 'required|date',
            'message' => 'nullable|string',
        ]);

        // default nếu không nhập
        $data['adult_count'] = $data['adult_count'] ?? 1;
        $data['child_count'] = $data['child_count'] ?? 0;
        $data['status'] = 'pending';

        if (Auth::check()) {
            $data['user_id'] = Auth::id();
        }

        Booking::create($data);

        return redirect()
            ->route('home')
            ->with('success', 'Đặt tour thành công!');
    }

    /**
     * (OPTIONAL) Danh sách booking user
     */
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('user.login');
        }

        $bookings = Booking::with('tour')
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('user.booking.index', compact('bookings'));
    }

    /**
     * (OPTIONAL) Xem chi tiết booking
     */
    public function show($id)
    {
        if (!Auth::check()) {
            return redirect()->route('user.login');
        }

        $booking = Booking::with('tour')
            ->where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return view('user.booking.show', compact('booking'));
    }

    /**
     * (OPTIONAL) Hủy booking
     */
    public function cancel($id)
    {
        if (!Auth::check()) {
            return redirect()->route('user.login');
        }

        $booking = Booking::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        if ($booking->status !== 'pending') {
            return back()->with('error', 'Không thể hủy');
        }

        $booking->update([
            'status' => 'cancelled'
        ]);

        return back()->with('success', 'Đã hủy booking');
    }
}