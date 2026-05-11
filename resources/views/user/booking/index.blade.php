@extends('layouts.user')

@section('title', 'Đơn đặt tour của tôi')

@section('content')
<div style="max-width: 1100px; margin: 30px auto; padding: 0 16px;">
    <h2 style="font-size: 28px; font-weight: 700; margin-bottom: 16px;">Đơn đặt tour của tôi</h2>

    @if(session('error'))
        <div style="background:#fee2e2; color:#991b1b; padding:12px 16px; border-radius:10px; margin-bottom: 16px;">
            {{ session('error') }}
        </div>
    @endif

    <div style="overflow-x:auto; background:#fff; border:1px solid #e5e7eb; border-radius: 12px;">
        <table style="width:100%; border-collapse: collapse;">
            <thead>
                <tr style="background:#f8fafc;">
                    <th style="text-align:left; padding:12px; border-bottom:1px solid #e5e7eb;">Booking</th>
                    <th style="text-align:left; padding:12px; border-bottom:1px solid #e5e7eb;">Tour</th>
                    <th style="text-align:left; padding:12px; border-bottom:1px solid #e5e7eb;">Ngày đi</th>
                    <th style="text-align:left; padding:12px; border-bottom:1px solid #e5e7eb;">Trạng thái</th>
                    <th style="text-align:left; padding:12px; border-bottom:1px solid #e5e7eb;">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse($bookings as $booking)
                    <tr>
                        <td style="padding:12px; border-bottom:1px solid #e5e7eb;">#{{ $booking->id }}</td>
                        <td style="padding:12px; border-bottom:1px solid #e5e7eb;">{{ $booking->tour?->name }}</td>
                        <td style="padding:12px; border-bottom:1px solid #e5e7eb;">{{ $booking->departure_date }}</td>
                        <td style="padding:12px; border-bottom:1px solid #e5e7eb;">{{ $booking->status }}</td>
                        <td style="padding:12px; border-bottom:1px solid #e5e7eb;">
                            <a href="{{ route('booking.show', $booking->id) }}">Xem</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="padding:16px; text-align:center; color:#64748b;">Chưa có booking nào</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="margin-top: 18px;">
        {{ $bookings->links() }}
    </div>
</div>
@endsection
