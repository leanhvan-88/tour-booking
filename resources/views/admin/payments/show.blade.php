@extends('admin.layouts.app')

@section('title', 'Chi tiết Thanh toán')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="glass-card">

        @if(session('success'))
            <div class="toast success">✅ {{ session('success') }}</div>
        @endif

        <div class="page-header">
            <div>
                <h2>Chi tiết thanh toán</h2>
                <p class="text-slate-400 mt-1">Payment #{{ $payment->id }}</p>
            </div>
        </div>

        <div class="card" style="margin-bottom: 20px;">
            <div><strong>Booking:</strong> #{{ $payment->booking_id }}</div>
            <div><strong>Tour:</strong> {{ $payment->booking?->tour?->name }}</div>
            <div><strong>Số tiền:</strong> {{ number_format($payment->amount) }}đ</div>
            <div><strong>Phương thức:</strong> {{ $payment->method }}</div>
            <div><strong>Trạng thái:</strong> {{ $payment->status }}</div>
            <div><strong>Paid at:</strong> {{ $payment->paid_at }}</div>
            <div style="margin-top: 12px;"><strong>Ghi chú:</strong></div>
            <div style="color:#cbd5e1; white-space: pre-wrap;">{{ $payment->note }}</div>
        </div>

        <form method="POST" action="{{ route('admin.payments.update', $payment) }}" class="form-content">
            @csrf

            <select name="status" class="status-select" style="width: 100%; margin-bottom: 14px;">
                <option value="pending"  @selected($payment->status==='pending')>pending</option>
                <option value="paid"     @selected($payment->status==='paid')>paid</option>
                <option value="failed"   @selected($payment->status==='failed')>failed</option>
                <option value="refunded" @selected($payment->status==='refunded')>refunded</option>
            </select>

            <button type="submit" class="btn-save">Cập nhật trạng thái</button>
        </form>

    </div>
</div>
@endsection
