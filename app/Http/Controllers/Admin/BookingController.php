<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;

class BookingController extends Controller
{
    // Danh sách booking
    public function index()
    {
        $bookings = Booking::with('tour')->latest()->paginate(10);

        return view('admin.bookings.index', compact('bookings'));
    }

    // Xem chi tiết
    public function show($id)
    {
        $booking = Booking::with('tour')->findOrFail($id);

        return view('admin.bookings.show', compact('booking'));
    }

    // Cập nhật trạng thái
    public function update(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);

        $request->validate([
            'status' => 'required|in:pending,contacted,done'
        ]);

        $booking->update([
            'status' => $request->status
        ]);

        return back()->with('success', 'Cập nhật trạng thái thành công');
    }

    // Xóa
    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();

        return back()->with('success', 'Xóa booking thành công');
    }
}