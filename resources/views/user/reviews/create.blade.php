@extends('layouts.user')

@section('title', 'Đánh giá tour')

@section('content')
<div style="max-width: 720px; margin: 30px auto; padding: 20px;">
    <h2 style="font-size: 28px; font-weight: 700; margin-bottom: 10px;">Đánh giá tour</h2>
    <div style="color:#64748b; margin-bottom: 18px;">Booking #{{ $booking->id }} - {{ $booking->tour?->name }}</div>

    @if(session('error'))
        <div style="background:#fee2e2; color:#991b1b; padding:12px 16px; border-radius:10px; margin-bottom: 16px;">
            {{ session('error') }}
        </div>
    @endif

    @if($errors->any())
        <div style="background:#fee2e2; color:#991b1b; padding:12px 16px; border-radius:10px; margin-bottom: 16px;">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('user.reviews.store', $booking->id) }}" style="display:flex; flex-direction:column; gap: 12px;">
        @csrf

        <label style="font-weight:600;">Số sao (1-5)</label>
        <input type="number" name="rating" min="1" max="5" value="{{ old('rating', 5) }}" required style="padding:12px 14px; border-radius:10px; border:1px solid #e5e7eb;">

        <label style="font-weight:600;">Nhận xét</label>
        <textarea name="comment" rows="6" style="padding:12px 14px; border-radius:10px; border:1px solid #e5e7eb;">{{ old('comment') }}</textarea>

        <button type="submit" style="padding:12px 14px; border-radius:10px; border:none; background:#0ea5e9; color:white; font-weight:600;">Gửi đánh giá</button>
    </form>
</div>
@endsection
