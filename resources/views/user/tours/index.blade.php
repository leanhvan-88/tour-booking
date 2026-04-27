@extends('layouts.user')

@section('title', 'Danh sách tour - Travel')

@section('content')

<div class="container tours-page">

    <h1>Danh sách tour du lịch</h1>

    <div class="tour-grid">

        @forelse($tours as $tour)
            <div class="tour-card">
                <img src="{{ $tour->image }}" alt="{{ $tour->name }}" class="tour-img">

                <div class="tour-body">
                    <h3>{{ $tour->name }}</h3>
                    
                    <p class="route">
                        {{ $tour->departure }} → {{ $tour->destination }}
                    </p>

                    @if(isset($tour->duration))
                    <p class="duration">{{ $tour->duration }} ngày • {{ $tour->nights ?? $tour->duration-1 }} đêm</p>
                    @endif

                    <p class="price">
                        {{ number_format($tour->price) }}đ
                    </p>

                    <a href="{{ route('tours.show', $tour->id) }}" class="btn">
                        Xem chi tiết & Đặt ngay
                    </a>
                </div>
            </div>
        @empty
            <div style="grid-column: 1 / -1; text-align: center; padding: 60px 20px;">
                <p style="font-size: 1.2rem; color: #64748b;">Chưa có tour nào phù hợp với tìm kiếm của bạn.</p>
            </div>
        @endforelse

    </div>

    <!-- Pagination -->
    <div class="pagination">
        {{ $tours->links() }}
    </div>

</div>

@endsection