<div class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <div class="logo">Travel<span>.</span></div>
        <div class="brand">Admin Panel</div>
    </div>

    <div class="menu">
        <a href="{{ route('admin.dashboard') }}" class="menu-item">
            <i class="ri-dashboard-3-line"></i>
            <span>Dashboard</span>
        </a>
        <a href="{{ route('admin.tours.index') }}" class="menu-item">
            <i class="ri-map-pin-2-line"></i>
            <span>Quản lý Tour</span>
        </a>
        <a href="{{ route('admin.bookings.index') }}" class="menu-item">
            <i class="ri-file-list-3-line"></i>
            <span>Đơn đặt tour</span>
        </a>

        <a href="{{ route('admin.categories.index') }}" class="menu-item">
            <i class="ri-folder-3-line"></i>
            <span>Danh mục</span>
        </a>

        <a href="{{ route('admin.reviews.index') }}" class="menu-item">
            <i class="ri-star-line"></i>
            <span>Đánh giá</span>
        </a>

        <a href="{{ route('admin.payments.index') }}" class="menu-item">
            <i class="ri-bank-card-line"></i>
            <span>Thanh toán</span>
        </a>

    </div>

    <!-- Phần dưới cùng của sidebar -->
    <!-- Sidebar Footer -->
<div class="sidebar-footer">
    <form method="POST" action="{{ route('admin.logout') }}" id="logout-form">
        @csrf
        <a href="#" onclick="document.getElementById('logout-form').submit()" class="menu-item">
            <i class="ri-logout-box-r-line"></i>
            <span>Đăng xuất</span>
        </a>
    </form>
</div>
</div>