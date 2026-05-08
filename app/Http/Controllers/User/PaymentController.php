<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function confirm(Request $request, $bookingId)
    {
        if (!Auth::check()) {
            return redirect()->route('user.login');
        }

        $booking = Booking::with(['tour'])
            ->where('id', $bookingId)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        if ($booking->status === 'cancelled') {
            return back()->with('error', 'Booking đã bị hủy');
        }

        $existingPaid = Payment::where('booking_id', $booking->id)->where('status', 'paid')->first();
        if ($existingPaid) {
            return back()->with('error', 'Booking này đã được xác nhận thanh toán');
        }

        $amount = 0;
        if ($booking->tour && $booking->tour->price) {
            $amount = (float) $booking->tour->price * (int) ($booking->adult_count ?? 1);
        }

        Payment::create([
            'booking_id' => $booking->id,
            'amount' => $amount,
            'method' => 'manual',
            'status' => 'paid',
            'transaction_ref' => null,
            'paid_at' => now(),
            'note' => 'User confirmed payment success',
        ]);

        return back()->with('success', 'Xác nhận thanh toán thành công');
    }
}
