<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $query = Payment::query()->with(['booking.tour'])->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->query('status'));
        }

        $payments = $query->paginate(10)->withQueryString();

        return view('admin.payments.index', compact('payments'));
    }

    public function show(Payment $payment)
    {
        $payment->load(['booking.tour']);

        return view('admin.payments.show', compact('payment'));
    }

    public function update(Request $request, Payment $payment)
    {
        $data = $request->validate([
            'status' => ['required', Rule::in(['pending', 'paid', 'failed', 'refunded'])],
        ]);

        $payload = ['status' => $data['status']];

        if ($data['status'] === 'paid' && $payment->paid_at === null) {
            $payload['paid_at'] = now();
        }

        $payment->update($payload);

        return back()->with('success', 'Cập nhật trạng thái thanh toán thành công');
    }

    public function destroy(Payment $payment)
    {
        $payment->delete();

        return back()->with('success', 'Xóa thanh toán thành công');
    }
}
