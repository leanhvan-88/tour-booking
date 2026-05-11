<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Travel - Tour Du Lịch Việt Nam & Quốc Tế')</title>

    <!-- FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
    
    <!-- CSS CHÍNH (1 file duy nhất) -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @stack('styles')
</head>

<body>

<!-- NAVBAR -->
<div class="navbar">
    <div class="logo">Travel<span>.</span></div>

    <div class="menu">
        <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Trang chủ</a>
        <a href="{{ route('tours.index') }}" class="{{ request()->routeIs('tours.*') ? 'active' : '' }}">Tour du lịch</a>
        <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">Giới thiệu</a>
    </div>

    <!-- Mobile Hamburger -->
    <button class="mobile-menu-btn" id="mobile-menu-btn">☰</button>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="mobile-menu">
        <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Trang chủ</a>
        <a href="{{ route('tours.index') }}" class="{{ request()->routeIs('tours.*') ? 'active' : '' }}">Tour du lịch</a>
        <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">Giới thiệu</a>

        @auth
            <a href="{{ route('booking.index') }}" class="{{ request()->routeIs('booking.*') ? 'active' : '' }}">Đơn của tôi</a>
            <form method="POST" action="{{ route('user.logout') }}" style="margin-top: 8px;">
                @csrf
                <button type="submit" style="background:none; border:none; padding:0; color:inherit; cursor:pointer;">Đăng xuất</button>
            </form>
        @else
            <a href="{{ route('user.login') }}" class="{{ request()->routeIs('user.login') ? 'active' : '' }}">Đăng nhập</a>
            <a href="{{ route('user.register') }}" class="{{ request()->routeIs('user.register') ? 'active' : '' }}">Đăng ký</a>
        @endauth
    </div>

    <div>
        @auth
            <a href="{{ route('booking.index') }}" style="margin-right: 12px;">Đơn của tôi</a>
            <form method="POST" action="{{ route('user.logout') }}" style="display:inline;">
                @csrf
                <button type="submit" style="background:#0ea5e9; color:white; border:none; padding:8px 12px; border-radius:10px; cursor:pointer; font-weight:600;">Đăng xuất</button>
            </form>
        @else
            <a href="{{ route('user.login') }}" style="margin-right: 12px;">Đăng nhập</a>
            <a href="{{ route('user.register') }}" style="background:#0ea5e9; color:white; padding:8px 12px; border-radius:10px; text-decoration:none; font-weight:600;">Đăng ký</a>
        @endauth
    </div>
</div>

<!-- TOAST -->
@if(session('success'))
<div id="toast-success">
    ✔ {{ session('success') }}
</div>
@endif

<!-- CONTENT -->
@yield('content')

<!-- FOOTER -->
<footer class="footer">
    <div class="container">
        <div class="footer-grid">
            <div>
                <div class="logo" style="margin-bottom: 12px;">Travel<span>.</span></div>
                <p style="max-width: 280px;">Nền tảng đặt tour du lịch uy tín nhất Việt Nam.<br>Hành trình đáng nhớ bắt đầu từ đây.</p>
            </div>
            <div>
                <h4>Khám phá</h4>
                <ul class="footer-list">
                    <li><a href="{{ route('tours.index') }}">Tour nổi bật</a></li>
                    <li><a href="#">Tour trong nước</a></li>
                    <li><a href="#">Tour quốc tế</a></li>
                    <li><a href="#">Điểm đến hot</a></li>
                </ul>
            </div>
            <div>
                <h4>Công ty</h4>
                <ul class="footer-list">
                    <li><a href="{{ route('about') }}">Về chúng tôi</a></li>
                    <li><a href="#">Blog du lịch</a></li>
                    <li><a href="#">Tuyển dụng</a></li>
                    <li><a href="#">Điều khoản</a></li>
                </ul>
            </div>
            <div>
                <h4>Liên hệ</h4>
                <p>Hotline: <strong style="color:#67e8f9;">1900 1234</strong></p>
                <p>Email: <strong style="color:#67e8f9;">info@travel.vn</strong></p>
                <p class="mt-6 text-xs">© {{ date('Y') }} Travel. All rights reserved.</p>
            </div>
        </div>
    </div>
</footer>

<script>
    // Auto hide toast
    setTimeout(() => {
        const toast = document.getElementById('toast-success');
        if (toast) {
            toast.style.transition = 'all 0.4s ease';
            toast.style.opacity = '0';
            toast.style.transform = 'translateX(150%)';
            setTimeout(() => toast.remove(), 500);
        }
    }, 4000);

    // Mobile Menu
    const mobileBtn = document.getElementById('mobile-menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    
    mobileBtn.addEventListener('click', () => {
        mobileMenu.style.display = mobileMenu.style.display === 'flex' ? 'none' : 'flex';
    });
</script>

@stack('scripts')

</body>
</html>