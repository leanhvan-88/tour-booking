@extends('layouts.user')

@section('title', $tour->name . ' - Travel')

@section('content')

<div class="container tour-detail">

    <!-- BANNER -->
    <div class="banner">
        <img src="{{ $tour->image }}" alt="{{ $tour->name }}">
        <div class="overlay">
            <h1>{{ $tour->name }}</h1>
            <p>{{ $tour->departure }} → {{ $tour->destination }}</p>
        </div>
    </div>

    <!-- MAIN CONTENT -->
    <div class="main">

        <!-- LEFT: Thông tin & Lịch trình -->
        <div class="left">

            <h2>Giới thiệu tour</h2>
            <p class="description">
                {{ $tour->description }}
            </p>

            <h2>Lịch trình chi tiết</h2>

            <div class="timeline">

                @foreach($days as $day => $items)
                    <div class="day-header" data-day="{{ $day }}">
                        <span class="day-number">{{ $day }}</span>
                        <span class="toggle-icon">↓</span>
                    </div>
                    
                    <div class="day-content">
                        @foreach($items as $item)
                            <div class="timeline-item">
                                {{ $item }}
                            </div>
                        @endforeach
                    </div>
                @endforeach

            </div>

        </div>

        <!-- RIGHT: Booking Box -->
        <div class="right">

            <div class="booking-box">
                <h3>{{ $tour->name }}</h3>
                
                <p class="price">
                    {{ number_format($tour->price) }}đ
                </p>

                <p class="info">
                    ⏱ {{ $tour->duration }} ngày<br>
                    📍 {{ $tour->departure }} - {{ $tour->destination }}
                </p>

                <a href="{{ route('booking.create', $tour->id) }}" class="btn-book">
                    Đặt tour ngay
                </a>
            </div>

        </div>

    </div>

</div>

@endsection

@push('scripts')
<script>
// Accordion cho lịch trình
document.querySelectorAll('.day-header').forEach(header => {
    header.addEventListener('click', () => {
        const content = header.nextElementSibling;
        const isOpen = content.classList.contains('show');
        
        // Đóng tất cả các ngày khác
        document.querySelectorAll('.day-content').forEach(item => {
            item.classList.remove('show');
        });
        
        document.querySelectorAll('.day-header').forEach(h => {
            h.classList.remove('active');
        });

        // Mở ngày được click
        if (!isOpen) {
            content.classList.add('show');
            header.classList.add('active');
        }
    });
});
</script>
@endpush