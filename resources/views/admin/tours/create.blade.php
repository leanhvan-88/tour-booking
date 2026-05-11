@extends('admin.layouts.app')

@section('title', 'Thêm Tour')

@section('content')
<div class="max-w-5xl mx-auto">
    <div class="glass-card">

        <div class="page-header">
            <div>
                <h2>Thêm tour</h2>
                <p class="text-slate-400 mt-1">Tạo tour mới</p>
            </div>
        </div>

        @if($errors->any())
            <div class="toast error">❌ {{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ route('admin.tours.store') }}" class="form-content">
            @csrf

            <div class="grid">
                <input type="text" name="name" value="{{ old('name') }}" placeholder="Tên tour *" required>
                <input type="number" name="price" value="{{ old('price') }}" placeholder="Giá (VNĐ)">
            </div>

            <div class="grid">
                <input type="number" name="duration" value="{{ old('duration') }}" placeholder="Số ngày *" required>
                <input type="text" name="image" value="{{ old('image') }}" placeholder="Link ảnh (URL)">
            </div>

            <div class="grid">
                <input type="text" name="departure" value="{{ old('departure') }}" placeholder="Điểm khởi hành *" required>
                <input type="text" name="destination" value="{{ old('destination') }}" placeholder="Điểm đến *" required>
            </div>

            <textarea name="description" rows="3" placeholder="Mô tả...">{{ old('description') }}</textarea>

            <label style="display:block; margin: 10px 0 8px; color:#cbd5e1;">Danh mục</label>
            <div style="display:grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 10px; margin-bottom: 16px;">
                @foreach($categories as $cat)
                    <label style="display:flex; gap:10px; align-items:center; background:#334155; border:1px solid #475569; padding:10px 12px; border-radius:12px;">
                        <input type="radio" name="category_id" value="{{ $cat->id }}" @checked((string)old('category_id') === (string)$cat->id)>
                        <span>{{ $cat->name }}</span>
                    </label>
                @endforeach
            </div>

            <textarea name="itinerary" rows="10" placeholder="Lịch trình theo ngày. Ví dụ:\nNGÀY 1: ...\n- ...\nNGÀY 2: ...\n- ...">{{ old('itinerary') }}</textarea>

            <button type="submit" class="btn-save">Lưu tour</button>
        </form>

    </div>
</div>
@endsection
