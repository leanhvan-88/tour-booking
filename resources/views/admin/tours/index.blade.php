@extends('admin.layouts.app')

@section('title', 'Quản lý Tour')

@section('content')

<div class="max-w-7xl mx-auto">

    <div class="glass-card">

        {{-- Toast --}}
        @if(session('success'))
            <div class="toast success">✅ {{ session('success') }}</div>
        @endif

        @if($errors->any())
            <div class="toast error">❌ {{ $errors->first() }}</div>
        @endif

        <!-- HEADER -->
        <div class="page-header">
            <div>
                <h2>Quản lý Tour</h2>
                <p class="text-slate-400 mt-1">Tổng cộng {{ $tours->total() ?? $tours->count() }} chuyến du lịch</p>
            </div>

            <a href="{{ route('admin.tours.create') }}" class="btn-primary" style="text-decoration:none;">
                <i class="ri-add-line"></i> Thêm Tour Mới
            </a>
        </div>

        <!-- TABLE -->
        <div class="overflow-x-auto">
            <table class="table-modern">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Ảnh</th>
                        <th>Tên Tour</th>
                        <th>Danh mục</th>
                        <th>Giá</th>
                        <th>Thời gian</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tours as $tour)
                    <tr>
                        <td><strong>#{{ $tour->id }}</strong></td>
                        <td>
                            <img src="{{ $tour->image }}" alt="{{ $tour->name }}" class="img-thumb">
                        </td>
                        <td>
                            <div style="font-weight: 500;">{{ $tour->name }}</div>
                            <small style="color: #94a3b8;">{{ $tour->departure }} → {{ $tour->destination }}</small>
                        </td>
                        <td style="color:#cbd5e1;">
                            {{ $tour->categories->pluck('name')->join(', ') ?: '-' }}
                        </td>
                        <td class="text-emerald-400 font-semibold">
                            {{ number_format($tour->price) }}đ
                        </td>
                        <td>{{ $tour->duration }} ngày</td>
                        <td>
                            <a href="{{ route('admin.tours.show', $tour) }}" class="btn-action btn-view" style="text-decoration:none;">Xem</a>

                            <a href="{{ route('admin.tours.edit', $tour) }}" class="btn-action btn-edit" style="text-decoration:none;">Sửa</a>
                          
                            <form method="POST" action="{{ route('admin.tours.destroy', $tour->id) }}" 
                                  style="display:inline;" 
                                  onsubmit="return confirm('Bạn chắc chắn muốn xóa tour này không?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-action btn-delete">Xóa</button>
                            </form>
                        </td>
                    </tr>

                    @empty
                    <tr>
                        <td colspan="7" style="text-align: center; padding: 80px 20px; color: #94a3b8;">
                            Chưa có tour nào. Hãy thêm tour mới!
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div style="margin-top: 30px; text-align: center;">
            {{ $tours->links() }}
        </div>

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