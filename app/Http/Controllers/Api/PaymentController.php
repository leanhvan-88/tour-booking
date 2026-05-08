<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $perPage = (int) $request->query('per_page', 15);

        $query = Payment::query()->with(['booking'])->orderByDesc('id');

        if ($request->filled('booking_id')) {
            $query->where('booking_id', $request->query('booking_id'));
        }

        if ($request->filled('status')) {
            $query->where('status', $request->query('status'));
        }

        return response()->json($query->paginate($perPage));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'booking_id' => ['required', 'integer', 'exists:bookings,id'],
            'amount' => ['required', 'numeric', 'min:0'],
            'method' => ['required', 'string', 'max:255'],
            'status' => ['nullable', Rule::in(['pending', 'paid', 'failed', 'refunded'])],
            'transaction_ref' => ['nullable', 'string', 'max:255'],
            'paid_at' => ['nullable', 'date'],
            'note' => ['nullable', 'string'],
        ]);

        $payment = Payment::create($data);

        return response()->json($payment->load(['booking']), 201);
    }

    public function show(Payment $payment)
    {
        return response()->json($payment->load(['booking']));
    }

    public function update(Request $request, Payment $payment)
    {
        $data = $request->validate([
            'booking_id' => ['sometimes', 'required', 'integer', 'exists:bookings,id'],
            'amount' => ['sometimes', 'required', 'numeric', 'min:0'],
            'method' => ['sometimes', 'required', 'string', 'max:255'],
            'status' => ['sometimes', 'required', Rule::in(['pending', 'paid', 'failed', 'refunded'])],
            'transaction_ref' => ['sometimes', 'nullable', 'string', 'max:255'],
            'paid_at' => ['sometimes', 'nullable', 'date'],
            'note' => ['sometimes', 'nullable', 'string'],
        ]);

        $payment->update($data);

        return response()->json($payment->load(['booking']));
    }

    public function destroy(Payment $payment)
    {
        $payment->delete();

        return response()->json(null, 204);
    }
}
