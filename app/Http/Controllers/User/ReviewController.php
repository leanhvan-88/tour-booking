<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function create($bookingId)
    {
        if (!Auth::check()) {
            return redirect()->route('user.login');
        }

        $booking = Booking::with(['tour'])
            ->where('id', $bookingId)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        if ($booking->status !== 'done') {
            return redirect()->route('booking.show', $booking->id)->with('error', 'Chỉ được đánh giá sau khi hoàn thành booking');
        }

        $existing = Review::where('booking_id', $booking->id)->first();
        if ($existing) {
            return redirect()->route('booking.show', $booking->id)->with('error', 'Booking này đã được đánh giá');
        }

        return view('user.reviews.create', compact('booking'));
    }

    public function store(Request $request, $bookingId)
    {
        if (!Auth::check()) {
            return redirect()->route('user.login');
        }

        $booking = Booking::with(['tour'])
            ->where('id', $bookingId)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        if ($booking->status !== 'done') {
            return back()->with('error', 'Chỉ được đánh giá sau khi hoàn thành booking');
        }

        $existing = Review::where('booking_id', $booking->id)->first();
        if ($existing) {
            return back()->with('error', 'Booking này đã được đánh giá');
        }

        $data = $request->validate([
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'comment' => ['nullable', 'string'],
        ]);

        Review::create([
            'tour_id' => $booking->tour_id,
            'booking_id' => $booking->id,
            'user_id' => Auth::id(),
            'full_name' => Auth::user()->name,
            'rating' => $data['rating'],
            'comment' => $data['comment'] ?? null,
            'status' => 'pending',
        ]);

        return redirect()->route('booking.show', $booking->id)->with('success', 'Gửi đánh giá thành công!');
    }
}
