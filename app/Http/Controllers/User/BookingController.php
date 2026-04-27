<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
        $bookings = Booking::latest()->paginate(10);

        return view('user.booking.index', compact('bookings'));
    }

    /**
     * (OPTIONAL) Xem chi tiết booking
     */
    public function show($id)
    {
        $booking = Booking::with('tour')->findOrFail($id);

        return view('user.booking.show', compact('booking'));
    }

    /**
     * (OPTIONAL) Hủy booking
     */
    public function cancel($id)
    {
        $booking = Booking::findOrFail($id);

        if ($booking->status !== 'pending') {
            return back()->with('error', 'Không thể hủy');
        }

        $booking->update([
            'status' => 'cancelled'
        ]);

        return back()->with('success', 'Đã hủy booking');
    }
}