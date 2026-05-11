@extends('admin.layouts.app')

@section('title', 'Quản lý Danh mục')

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="glass-card">

        @if(session('success'))
            <div class="toast success">✅ {{ session('success') }}</div>
        @endif

        <div class="page-header">
            <div>
                <h2>Danh mục</h2>
                <p class="text-slate-400 mt-1">Tổng cộng {{ $categories->total() ?? $categories->count() }} danh mục</p>
            </div>

            <a href="{{ route('admin.categories.create') }}" class="btn-primary">
                <i class="ri-add-line"></i> Thêm danh mục
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="table-modern">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên</th>
                        <th>Slug</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $category)
                        <tr>
                            <td><strong>#{{ $category->id }}</strong></td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->slug }}</td>
                            <td>
                                <a href="{{ route('admin.categories.edit', $category) }}" class="btn-action btn-edit">Sửa</a>

                                <form method="POST" action="{{ route('admin.categories.destroy', $category) }}" style="display:inline;" onsubmit="return confirm('Bạn chắc chắn muốn xóa danh mục này không?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action btn-delete">Xóa</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" style="text-align:center; padding: 40px 20px; color:#94a3b8;">Chưa có danh mục</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div style="margin-top: 30px; text-align: center;">
            {{ $categories->links() }}
        </div>

    </div>
</div>
@endsection
