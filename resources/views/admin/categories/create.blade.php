@extends('admin.layouts.app')

@section('title', 'Thêm danh mục')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="glass-card">

        <div class="page-header">
            <div>
                <h2>Thêm danh mục</h2>
                <p class="text-slate-400 mt-1">Tạo danh mục để phân loại tour</p>
            </div>
        </div>

        @if($errors->any())
            <div class="toast error">❌ {{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ route('admin.categories.store') }}" class="form-content">
            @csrf

            <input type="text" name="name" value="{{ old('name') }}" placeholder="Tên danh mục *" required>
            <input type="text" name="slug" value="{{ old('slug') }}" placeholder="Slug *" required>

            <button type="submit" class="btn-save">Lưu</button>
        </form>

    </div>
</div>
@endsection
