@extends('admin.layouts.app')

@section('title', 'Chi tiết Booking #' . $booking->id)

@section('content')

<div class="glass-card">

    <!-- HEADER -->
    <div class="page-header">
        <div>
            <h2>Chi tiết Booking #{{ $booking->id }}</h2>
            <p class="text-slate-400">Thông tin đơn đặt tour</p>
        </div>
        
        <div>
            <a href="{{ route('admin.bookings.index') }}" class="btn-secondary">
                ← Quay lại danh sách
            </a>
        </div>
    </div>

    <div class="booking-detail-grid">

        <!-- Thông tin khách hàng -->
        <div class="detail-card">
            <h3><i class="ri-user-line"></i> Thông tin khách hàng</h3>
            <div class="detail-item">
                <span class="label">Họ và tên:</span>
                <span class="value">{{ $booking->full_name }}</span>
            </div>
            <div class="detail-item">
                <span class="label">Số điện thoại:</span>
                <span class="value">{{ $booking->phone }}</span>
            </div>
            <div class="detail-item">
                <span class="label">Email:</span>
                <span class="value">{{ $booking->email ?? 'Không có' }}</span>
            </div>
        </div>

        <!-- Thông tin tour -->
        <div class="detail-card">
            <h3><i class="ri-map-pin-line"></i> Thông tin tour</h3>
            <div class="detail-item">
                <span class="label">Tên tour:</span>
                <span class="value">{{ $booking->tour->name ?? 'Tour không tồn tại' }}</span>
            </div>
            <div class="detail-item">
                <span class="label">Ngày khởi hành:</span>
                <span class="value">{{ \Carbon\Carbon::parse($booking->departure_date)->format('d/m/Y') }}</span>
            </div>
            <div class="detail-item">
                <span class="label">Số người:</span>
                <span class="value">
                    {{ $booking->adult_count }} người lớn 
                    @if($booking->child_count > 0)
                        + {{ $booking->child_count }} trẻ em
                    @endif
                </span>
            </div>
        </div>

        <!-- Trạng thái & Ghi chú -->
        <div class="detail-card full-width">
            <h3><i class="ri-information-line"></i> Trạng thái & Ghi chú</h3>
            
            <div class="status-section">
                <span class="label">Trạng thái hiện tại:</span>
                <span class="status-badge {{ $booking->status }}">
                    @php
                        $statusText = [
                            'pending' => '⏳ Chờ xử lý',
                            'contacted' => '📞 Đã liên hệ',
                            'confirmed' => '✅ Đã xác nhận',
                            'done' => '🎉 Hoàn tất',
                            'cancelled' => '❌ Đã hủy'
                        ];
                    @endphp
                    {{ $statusText[$booking->status] ?? ucfirst($booking->status) }}
                </span>
            </div>

            @if($booking->message)
            <div class="note-section">
                <span class="label">Ghi chú từ khách hàng:</span>
                <div class="note-box">
                    "{{ $booking->message }}"
                </div>
            </div>
            @endif
        </div>

    </div>

    <!-- Hành động -->
    <div class="action-buttons">
        <a href="{{ route('admin.bookings.index') }}" class="btn-secondary">Quay lại danh sách</a>
        
        @if($booking->status != 'done' && $booking->status != 'cancelled')
            <form method="POST" action="{{ route('admin.bookings.update', $booking->id) }}" style="display:inline;">
                @csrf
                <input type="hidden" name="status" value="done">
                <button type="submit" class="btn-success">Hoàn tất đơn</button>
            </form>
        @endif

        <form method="POST" action="{{ route('admin.bookings.delete', $booking->id) }}" style="display:inline;" 
              onsubmit="return confirm('Bạn chắc chắn muốn xóa đơn này?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn-danger">Xóa đơn booking</button>
        </form>
    </div>

</div>

@endsection

@push('styles')
<style>
/* Booking Detail Styles */
.booking-detail-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 24px;
    margin-bottom: 40px;
}

.detail-card {
    background: #1e293b;
    padding: 28px;
    border-radius: 16px;
    border: 1px solid rgba(148, 163, 184, 0.1);
}

.detail-card.full-width {
    grid-column: 1 / -1;
}

.detail-card h3 {
    margin-bottom: 20px;
    color: #e2e8f0;
    font-size: 18px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.detail-item {
    display: flex;
    justify-content: space-between;
    padding: 12px 0;
    border-bottom: 1px solid #334155;
}

.detail-item:last-child {
    border-bottom: none;
}

.label {
    color: #94a3b8;
    font-weight: 500;
}

.value {
    font-weight: 500;
    color: white;
}

.status-section {
    margin-bottom: 24px;
}

.status-badge {
    padding: 8px 20px;
    border-radius: 9999px;
    font-weight: 600;
    display: inline-block;
}

.status-badge.pending    { background: #fbbf24; color: #000; }
.status-badge.contacted  { background: #60a5fa; color: white; }
.status-badge.confirmed  { background: #34d399; color: white; }
.status-badge.done       { background: #22c55e; color: white; }
.status-badge.cancelled  { background: #ef4444; color: white; }

.note-section .label {
    display: block;
    margin-bottom: 8px;
}

.note-box {
    background: #0f172a;
    padding: 20px;
    border-radius: 12px;
    font-style: italic;
    color: #cbd5e1;
    line-height: 1.7;
}

.action-buttons {
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
}

.btn-secondary {
    background: #475569;
    color: white;
    padding: 12px 24px;
    border-radius: 9999px;
    text-decoration: none;
    font-weight: 500;
}

.btn-success {
    background: #22c55e;
    color: white;
    padding: 12px 24px;
    border: none;
    border-radius: 9999px;
    font-weight: 600;
    cursor: pointer;
}

.btn-danger {
    background: #ef4444;
    color: white;
    padding: 12px 24px;
    border: none;
    border-radius: 9999px;
    font-weight: 600;
    cursor: pointer;
}

.btn-secondary:hover, .btn-success:hover, .btn-danger:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 15px rgba(0,0,0,0.2);
}
</style>
@endpush