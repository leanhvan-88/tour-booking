@extends('admin.layouts.app')

@section('title', 'Chi tiết Đánh giá')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="glass-card">

        @if(session('success'))
            <div class="toast success">✅ {{ session('success') }}</div>
        @endif

        <div class="page-header">
            <div>
                <h2>Chi tiết đánh giá</h2>
                <p class="text-slate-400 mt-1">Review #{{ $review->id }}</p>
            </div>
        </div>

        <div class="card" style="margin-bottom: 20px;">
            <div><strong>Tour:</strong> {{ $review->tour?->name }}</div>
            <div><strong>Người đánh giá:</strong> {{ $review->user?->name ?? $review->full_name ?? 'N/A' }}</div>
            <div><strong>Số sao:</strong> {{ $review->rating }}/5</div>
            <div style="margin-top: 12px;"><strong>Nội dung:</strong></div>
            <div style="color:#cbd5e1; white-space: pre-wrap;">{{ $review->comment }}</div>
        </div>

        <form method="POST" action="{{ route('admin.reviews.update', $review) }}" class="form-content">
            @csrf

            <select name="status" class="status-select" style="width: 100%; margin-bottom: 14px;">
                <option value="pending"  @selected($review->status==='pending')>pending</option>
                <option value="approved" @selected($review->status==='approved')>approved</option>
                <option value="rejected" @selected($review->status==='rejected')>rejected</option>
            </select>

            <button type="submit" class="btn-save">Cập nhật trạng thái</button>
        </form>

    </div>
</div>
@endsection
