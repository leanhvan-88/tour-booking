@extends('admin.layouts.app')

@section('title', 'Quản lý Booking')

@section('content')

<div class="glass-card">

    {{-- Toast --}}
    @if(session('success'))
        <div class="toast success">✅ {{ session('success') }}</div>
    @endif

    <!-- HEADER -->
    <div class="page-header">
        <div>
            <h2>Quản lý Đơn Đặt Tour</h2>
            <p class="text-slate-400 mt-1">Tổng cộng {{ $bookings->total() ?? $bookings->count() }} đơn đặt tour</p>
        </div>
    </div>

    <!-- TABLE -->
    <div class="overflow-x-auto">
        <table class="table-modern">
            <thead>
                <tr>
                    <th>#ID</th>
                    <th>Khách hàng</th>
                    <th>Tour</th>
                    <th>Số điện thoại</th>
                    <th>Ngày đi</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse($bookings as $b)
                <tr>
                    <td><strong>#{{ $b->id }}</strong></td>
                    <td>
                        <div style="font-weight: 500;">{{ $b->full_name }}</div>
                        <small style="color: #94a3b8;">{{ $b->email ?? 'Không có email' }}</small>
                    </td>
                    <td>
                        <div style="font-weight: 500;">{{ $b->tour->name ?? 'Tour không tồn tại' }}</div>
                    </td>
                    <td>{{ $b->phone }}</td>
                    <td>{{ \Carbon\Carbon::parse($b->departure_date)->format('d/m/Y') }}</td>
                    
                    <td>
                        <form method="POST" action="{{ route('admin.bookings.update', $b->id) }}" style="margin: 0;">
                            @csrf
                            <select name="status" onchange="this.form.submit()" class="status-select">
                                <option value="pending" {{ $b->status == 'pending' ? 'selected' : '' }}>⏳ Chờ xử lý</option>
                                <option value="contacted" {{ $b->status == 'contacted' ? 'selected' : '' }}>📞 Đã liên hệ</option>
                                <option value="confirmed" {{ $b->status == 'confirmed' ? 'selected' : '' }}>✅ Đã xác nhận</option>
                                <option value="done" {{ $b->status == 'done' ? 'selected' : '' }}>🎉 Hoàn tất</option>
                                <option value="cancelled" {{ $b->status == 'cancelled' ? 'selected' : '' }}>❌ Đã hủy</option>
                            </select>
                        </form>
                    </td>

                    <td>
                        <a href="{{ route('admin.bookings.show', $b->id) }}" class="btn-action btn-view">
                            Xem chi tiết
                        </a>
                        <form method="POST" action="{{ route('admin.bookings.delete', $b->id) }}" 
                              style="display:inline;" 
                              onsubmit="return confirm('Bạn chắc chắn muốn xóa đơn đặt tour này?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-action btn-del">Xóa</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="text-align:center; padding:80px 20px; color:#94a3b8;">
                        Chưa có đơn đặt tour nào.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div style="margin-top: 30px; text-align: center;">
        {{ $bookings->links() }}
    </div>

</div>

@endsection

@push('scripts')
<script>
// Auto hide toast
setTimeout(() => {
    document.querySelectorAll('.toast').forEach(t => t.remove());
}, 4000);
</script>
@endpush