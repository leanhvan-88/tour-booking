@extends('admin.layouts.app')

@section('title', 'Sửa danh mục')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="glass-card">

        <div class="page-header">
            <div>
                <h2>Sửa danh mục</h2>
                <p class="text-slate-400 mt-1">Cập nhật thông tin danh mục</p>
            </div>
        </div>

        @if($errors->any())
            <div class="toast error">❌ {{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ route('admin.categories.update', $category) }}" class="form-content">
            @csrf
            @method('PUT')

            <input type="text" name="name" value="{{ old('name', $category->name) }}" placeholder="Tên danh mục *" required>
            <input type="text" name="slug" value="{{ old('slug', $category->slug) }}" placeholder="Slug *" required>

            <button type="submit" class="btn-save">Cập nhật</button>
        </form>

    </div>
</div>
@endsection
