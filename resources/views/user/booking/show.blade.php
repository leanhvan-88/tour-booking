@extends('layouts.user')

@section('title', 'Chi tiết booking')

@section('content')
<div style="max-width: 900px; margin: 30px auto; padding: 0 16px;">
    <h2 style="font-size: 28px; font-weight: 700; margin-bottom: 10px;">Chi tiết booking</h2>

    @if(session('success'))
        <div style="background:#dcfce7; color:#166534; padding:12px 16px; border-radius:10px; margin-bottom: 16px;">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div style="background:#fee2e2; color:#991b1b; padding:12px 16px; border-radius:10px; margin-bottom: 16px;">
            {{ session('error') }}
        </div>
    @endif

    <div style="background:#fff; border:1px solid #e5e7eb; border-radius:12px; padding: 16px;">
        <div><strong>Mã:</strong> #{{ $booking->id }}</div>
        <div><strong>Tour:</strong> {{ $booking->tour?->name }}</div>
        <div><strong>Ngày đi:</strong> {{ $booking->departure_date }}</div>
        <div><strong>Số người lớn:</strong> {{ $booking->adult_count }}</div>
        <div><strong>Trẻ em:</strong> {{ $booking->child_count }}</div>
        <div><strong>Trạng thái:</strong> {{ $booking->status }}</div>
    </div>

    <div style="display:flex; gap: 12px; flex-wrap: wrap; margin-top: 16px;">
        <form method="POST" action="{{ route('user.payments.confirm', $booking->id) }}">
            @csrf
            <button type="submit" style="padding:10px 12px; border-radius:10px; border:none; background:#16a34a; color:#fff; font-weight:600;">Xác nhận thanh toán thành công</button>
        </form>

        <a href="{{ route('user.reviews.create', $booking->id) }}" style="padding:10px 12px; border-radius:10px; border:1px solid #0ea5e9; color:#0ea5e9; font-weight:600; text-decoration:none;">Viết đánh giá</a>

        <form method="POST" action="{{ route('booking.cancel', $booking->id) }}">
            @csrf
            <button type="submit" style="padding:10px 12px; border-radius:10px; border:none; background:#ef4444; color:#fff; font-weight:600;" onclick="return confirm('Bạn chắc chắn muốn hủy booking này?')">Hủy booking</button>
        </form>
    </div>
</div>
@endsection
