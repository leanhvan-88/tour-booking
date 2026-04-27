@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="glass-card">

    <!-- Welcome Header -->
    <div class="welcome-section">
        <h1>Xin chào, Quản trị viên 👋</h1>
        <p class="text-slate-400">Chúc bạn một ngày làm việc hiệu quả!</p>
    </div>

    <!-- Stats Cards -->
    <div class="stats-grid">
        
        <div class="stat-card">
            <div class="stat-icon">🗺️</div>
            <div class="stat-info">
                <h3>{{ number_format($totalTours ?? 0) }}</h3>
                <p>Tổng số tour</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">📋</div>
            <div class="stat-info">
                <h3>{{ number_format($totalBookings ?? 0) }}</h3>
                <p>Tổng đơn booking</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">⏳</div>
            <div class="stat-info">
                <h3>{{ number_format($pendingBookings ?? 0) }}</h3>
                <p>Đơn chờ xử lý</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">✅</div>
            <div class="stat-info">
                <h3>{{ number_format($completedBookings ?? 0) }}</h3>
                <p>Đơn đã hoàn tất</p>
            </div>
        </div>

    </div>

    <!-- Recent Bookings -->
    <div class="recent-section">
        <div class="section-header">
            <h3>Đơn đặt tour gần đây</h3>
            <a href="{{ route('admin.bookings.index') }}" class="view-all">Xem tất cả →</a>
        </div>

        @if($recentBookings && $recentBookings->count() > 0)
        <div class="overflow-x-auto">
            <table class="table-modern">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Khách hàng</th>
                        <th>Tour</th>
                        <th>Ngày đi</th>
                        <th>Trạng thái</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentBookings as $booking)
                    <tr>
                        <td>#{{ $booking->id }}</td>
                        <td>{{ $booking->full_name }}</td>
                        <td>{{ $booking->tour->name ?? 'N/A' }}</td>
                        <td>{{ \Carbon\Carbon::parse($booking->departure_date)->format('d/m/Y') }}</td>
                        <td>
                            <span class="status-badge {{ $booking->status }}">
                                @php
                                    $status = [
                                        'pending' => '⏳ Chờ xử lý',
                                        'contacted' => '📞 Đã liên hệ',
                                        'confirmed' => '✅ Xác nhận',
                                        'done' => '🎉 Hoàn tất',
                                        'cancelled' => '❌ Hủy'
                                    ];
                                @endphp
                                {{ $status[$booking->status] ?? ucfirst($booking->status) }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
            <p style="text-align: center; padding: 40px; color: #94a3b8;">Chưa có đơn đặt tour nào gần đây.</p>
        @endif
    </div>

</div>

@endsection

@push('styles')
<style>
/* Dashboard Styles */
.welcome-section {
    margin-bottom: 40px;
}

.welcome-section h1 {
    font-size: 32px;
    font-weight: 700;
    color: white;
    margin-bottom: 8px;
}

/* Stats Grid */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
    gap: 24px;
    margin-bottom: 50px;
}

.stat-card {
    background: #1e293b;
    padding: 28px 24px;
    border-radius: 20px;
    display: flex;
    align-items: center;
    gap: 20px;
    transition: transform 0.3s;
}

.stat-card:hover {
    transform: translateY(-6px);
}

.stat-icon {
    font-size: 42px;
    width: 70px;
    height: 70px;
    background: rgba(14, 165, 233, 0.15);
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.stat-info h3 {
    font-size: 32px;
    font-weight: 700;
    color: white;
    margin-bottom: 4px;
}

.stat-info p {
    color: #94a3b8;
    font-size: 15px;
}

/* Recent Bookings */
.recent-section {
    background: #1e293b;
    padding: 28px;
    border-radius: 20px;
}

.section-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.section-header h3 {
    font-size: 20px;
    font-weight: 600;
}

.view-all {
    color: var(--primary);
    text-decoration: none;
    font-weight: 500;
}

.view-all:hover {
    text-decoration: underline;
}
</style>
@endpush