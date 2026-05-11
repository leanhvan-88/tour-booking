@extends('admin.layouts.app')

@section('title', 'Quản lý Đánh giá')

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="glass-card">

        @if(session('success'))
            <div class="toast success">✅ {{ session('success') }}</div>
        @endif

        <div class="page-header">
            <div>
                <h2>Đánh giá</h2>
                <p class="text-slate-400 mt-1">Quản lý review của khách hàng</p>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="table-modern">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tour</th>
                        <th>Người đánh giá</th>
                        <th>Sao</th>
                        <th>Trạng thái</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reviews as $review)
                        <tr>
                            <td><strong>#{{ $review->id }}</strong></td>
                            <td>{{ $review->tour?->name }}</td>
                            <td>{{ $review->user?->name ?? $review->full_name ?? 'N/A' }}</td>
                            <td>{{ $review->rating }}/5</td>
                            <td>{{ $review->status }}</td>
                            <td>
                                <a href="{{ route('admin.reviews.show', $review) }}" class="btn-action btn-view">Xem</a>

                                <form method="POST" action="{{ route('admin.reviews.update', $review) }}" style="display:inline;">
                                    @csrf
                                    <select name="status" class="status-select" onchange="this.form.submit()">
                                        <option value="pending"  @selected($review->status==='pending')>pending</option>
                                        <option value="approved" @selected($review->status==='approved')>approved</option>
                                        <option value="rejected" @selected($review->status==='rejected')>rejected</option>
                                    </select>
                                </form>

                                <form method="POST" action="{{ route('admin.reviews.destroy', $review) }}" style="display:inline;" onsubmit="return confirm('Xóa review này?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action btn-delete">Xóa</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align:center; padding: 40px 20px; color:#94a3b8;">Chưa có đánh giá</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div style="margin-top: 30px; text-align: center;">
            {{ $reviews->links() }}
        </div>

    </div>
</div>
@endsection
