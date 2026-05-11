@extends('admin.layouts.app')

@section('title', 'Quản lý Thanh toán')

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="glass-card">

        @if(session('success'))
            <div class="toast success">✅ {{ session('success') }}</div>
        @endif

        <div class="page-header">
            <div>
                <h2>Thanh toán</h2>
                <p class="text-slate-400 mt-1">Danh sách xác nhận thanh toán</p>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="table-modern">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Booking</th>
                        <th>Tour</th>
                        <th>Số tiền</th>
                        <th>Trạng thái</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($payments as $payment)
                        <tr>
                            <td><strong>#{{ $payment->id }}</strong></td>
                            <td>#{{ $payment->booking_id }}</td>
                            <td>{{ $payment->booking?->tour?->name }}</td>
                            <td class="text-emerald-400 font-semibold">{{ number_format($payment->amount) }}đ</td>
                            <td>{{ $payment->status }}</td>
                            <td>
                                <a href="{{ route('admin.payments.show', $payment) }}" class="btn-action btn-view">Xem</a>

                                <form method="POST" action="{{ route('admin.payments.update', $payment) }}" style="display:inline;">
                                    @csrf
                                    <select name="status" class="status-select" onchange="this.form.submit()">
                                        <option value="pending"  @selected($payment->status==='pending')>pending</option>
                                        <option value="paid"     @selected($payment->status==='paid')>paid</option>
                                        <option value="failed"   @selected($payment->status==='failed')>failed</option>
                                        <option value="refunded" @selected($payment->status==='refunded')>refunded</option>
                                    </select>
                                </form>

                                <form method="POST" action="{{ route('admin.payments.destroy', $payment) }}" style="display:inline;" onsubmit="return confirm('Xóa thanh toán này?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action btn-delete">Xóa</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align:center; padding: 40px 20px; color:#94a3b8;">Chưa có thanh toán</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div style="margin-top: 30px; text-align: center;">
            {{ $payments->links() }}
        </div>

    </div>
</div>
@endsection
