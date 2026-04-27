@extends('layouts.user')

@section('title', 'Trang chủ - Travel | Tour Du Lịch Việt Nam & Quốc Tế')

@section('content')

<div class="bg-[#f8f7f4]">

    <!-- HERO -->
    <section class="hero">
        <div class="hero-content">
            <div class="hero-text">
                <p class="uppercase tracking-widest text-sky-300 text-sm font-medium">Khám phá thế giới cùng Travel</p>
                <h1 class="font-serif">Hành trình đáng nhớ<br>bắt đầu từ đây</h1>
                <p>Hàng trăm tour du lịch chất lượng cao từ biển đảo đến núi rừng. Đặt tour dễ dàng chỉ với vài click.</p>
                <a href="{{ route('tours.index') }}" class="btn-primary mt-8">
                    Tìm tour ngay
                    <span>→</span>
                </a>
            </div>

            <!-- Carousel -->
            <div id="hero-carousel">
                <img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e" alt="Biển Đà Nẵng" class="active">
                <img src="https://images.unsplash.com/photo-1540979388789-6cee28a1cdc9" alt="Sapa hùng vĩ">
                <img src="https://images.unsplash.com/photo-1587502537745-84b86da1204f" alt="Phú Quốc đẹp mê hồn">
            </div>
        </div>
    </section>

    <!-- SEARCH BAR -->
    <div class="search-bar container">
        <form action="{{ route('tours.index') }}" method="GET" class="flex flex-col md:flex-row gap-4">
            <input type="text" name="q" placeholder="Bạn muốn đi đâu? Ví dụ: Đà Nẵng, Phú Quốc, Sapa..." class="flex-1">
            <button type="submit">Tìm tour</button>
        </form>
    </div>

    <!-- TOUR NỔI BẬT -->
    <div class="container py-20">
        <div class="flex justify-between items-center mb-12">
            <h2 class="section-title">Tour nổi bật</h2>
            <a href="{{ route('tours.index') }}" class="text-sky-600 hover:underline text-lg">Xem tất cả →</a>
        </div>

        <div class="tour-grid">
            @foreach($tours->take(6) as $tour)
            <div class="tour-card relative">
                <img src="{{ $tour->image }}" alt="{{ $tour->name }}">
                <div class="price">{{ number_format($tour->price) }}đ</div>
                <div class="content">
                    <h3>{{ $tour->name }}</h3>
                    <p class="text-slate-500">{{ $tour->departure }} → {{ $tour->destination }}</p>
                    <p class="text-emerald-600 font-medium mt-1">{{ $tour->duration }} ngày</p>
                    
                    <a href="{{ route('tours.show', $tour->id) }}" 
                       class="mt-auto block text-center bg-slate-900 text-white py-4 rounded-2xl hover:bg-black transition font-medium">
                        Xem chi tiết & Đặt ngay
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- TẠI SAO CHỌN + ĐÁNH GIÁ -->
    <div class="why-us">
        <div class="container">
            <h2 class="section-title">Khách hàng nói gì về Travel?</h2>
            
            <div class="why-grid">
                <!-- Tại sao chọn chúng tôi -->
                <div class="testimonial-card">
                    <h3 class="font-semibold text-2xl mb-8">Tại sao khách hàng yêu thích Travel?</h3>
                    <div class="space-y-8">
                        <div class="flex gap-4">
                            <span class="text-4xl">🛡️</span>
                            <div>
                                <h4 class="font-semibold text-xl">An toàn tuyệt đối</h4>
                                <p class="text-slate-600 mt-1">Bảo hiểm du lịch + đối tác uy tín</p>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <span class="text-4xl">🌟</span>
                            <div>
                                <h4 class="font-semibold text-xl">Chất lượng cao</h4>
                                <p class="text-slate-600 mt-1">Hướng dẫn viên chuyên nghiệp</p>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <span class="text-4xl">💰</span>
                            <div>
                                <h4 class="font-semibold text-xl">Giá tốt nhất</h4>
                                <p class="text-slate-600 mt-1">Không phí ẩn, nhiều ưu đãi</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Đánh giá khách hàng -->
                @php
                $testimonials = [
                    ['name' => 'Nguyễn Thị Lan', 'role' => 'Tour Phú Quốc 2025', 'quote' => 'Tour cực kỳ chu đáo, hướng dẫn viên rất nhiệt tình. Cảm giác như đi cùng gia đình!'],
                    ['name' => 'Trần Minh Quân', 'role' => 'Tour Sapa', 'quote' => 'Cảnh đẹp, ăn ngon, lịch trình hợp lý. Mình đã đặt tour lần thứ hai.'],
                    ['name' => 'Phạm Thu Hà', 'role' => 'Tour Đà Lạt', 'quote' => 'Giá hợp lý, dịch vụ tuyệt vời. Rất hài lòng và sẽ giới thiệu cho bạn bè.'],
                ];
                @endphp

                @foreach($testimonials as $t)
                <div class="testimonial-card">
                    <p class="italic text-lg leading-relaxed">"{{ $t['quote'] }}"</p>
                    <div class="mt-8 flex items-center gap-4">
                        <div class="w-12 h-12 bg-sky-100 rounded-full flex items-center justify-center text-3xl">👤</div>
                        <div>
                            <p class="font-semibold">{{ $t['name'] }}</p>
                            <p class="text-sm text-slate-500">{{ $t['role'] }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

</div>

@endsection

@push('scripts')
<script>
// Hero Carousel
const slides = document.querySelectorAll('#hero-carousel img');
let currentSlide = 0;

function showSlide() {
    slides.forEach(slide => slide.classList.remove('active'));
    slides[currentSlide].classList.add('active');
    currentSlide = (currentSlide + 1) % slides.length;
}

setInterval(showSlide, 4800);
showSlide(); // Show first slide
</script>
@endpush