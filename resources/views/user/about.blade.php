@extends('layouts.user')

@section('title', 'Về chúng tôi - Travel')

@section('content')

<div class="container about-page">

    <!-- HERO -->
    <div class="hero">
        <div class="hero-content">
            <h1>Về Travel</h1>
            <p>Khám phá thế giới cùng chúng tôi – Những hành trình đáng nhớ bắt đầu từ đây</p>
        </div>
    </div>

    <!-- ABOUT US -->
    <div class="about-section">
        <div class="about-text">
            <h2>Chúng tôi là ai?</h2>
            <p>
                Travel là nền tảng đặt tour du lịch hàng đầu Việt Nam, được thành lập với sứ mệnh mang đến những trải nghiệm du lịch chất lượng cao, an toàn và đáng nhớ cho mọi khách hàng.
            </p>
            <p>
                Với đội ngũ hơn 50 chuyên gia du lịch giàu kinh nghiệm và hệ thống đối tác uy tín tại hơn 30 quốc gia & vùng lãnh thổ, chúng tôi tự hào đã đồng hành cùng hơn 120.000 khách hàng trong những năm qua.
            </p>
        </div>

        <div class="about-img">
            <img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e" alt="Travel Team">
        </div>
    </div>

    <!-- STATISTICS -->
    <div class="stats">
        <div class="stat-item">
            <h3>120k+</h3>
            <p>Khách hàng hài lòng</p>
        </div>
        <div class="stat-item">
            <h3>450+</h3>
            <p>Tour du lịch chất lượng</p>
        </div>
        <div class="stat-item">
            <h3>8</h3>
            <p>Năm kinh nghiệm</p>
        </div>
        <div class="stat-item">
            <h3>98%</h3>
            <p>Khách hàng quay lại</p>
        </div>
    </div>

    <!-- VALUES / FEATURES -->
    <div class="values">
        <h2>Giá trị cốt lõi của Travel</h2>
        
        <div class="feature-grid">
            <div class="feature">
                <span class="icon">🌍</span>
                <h3>Đa dạng điểm đến</h3>
                <p>Hàng trăm tour trong nước và quốc tế, từ biển đảo đến núi rừng, từ văn hóa đến phiêu lưu.</p>
            </div>

            <div class="feature">
                <span class="icon">🛡️</span>
                <h3>An toàn tuyệt đối</h3>
                <p>Bảo hiểm du lịch toàn diện, đối tác uy tín, hướng dẫn viên chuyên nghiệp.</p>
            </div>

            <div class="feature">
                <span class="icon">💰</span>
                <h3>Giá cả minh bạch</h3>
                <p>Cam kết giá tốt nhất, không phí ẩn, nhiều chương trình ưu đãi hấp dẫn.</p>
            </div>

            <div class="feature">
                <span class="icon">⚡</span>
                <h3>Đặt tour nhanh chóng</h3>
                <p>Quy trình đặt tour chỉ trong 60 giây. Hỗ trợ thanh toán đa dạng và linh hoạt.</p>
            </div>
        </div>
    </div>

</div>

@endsection