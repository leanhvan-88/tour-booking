@extends('layouts.user')

@section('title', 'Liên hệ - Travel')

@section('content')

<div class="container contact-page">

    <!-- HERO -->
    <div class="hero">
        <div class="hero-content">
            <h1>Liên hệ với Travel</h1>
            <p>Chúng tôi luôn sẵn sàng hỗ trợ bạn. Hãy để lại thông tin, chúng tôi sẽ liên hệ sớm nhất!</p>
        </div>
    </div>

    <div class="contact-main">

        <!-- LEFT: Thông tin liên hệ -->
        <div class="contact-info">
            <h2>Thông tin liên hệ</h2>

            <div class="info-card">
                <div class="info-item">
                    <span class="icon">📍</span>
                    <div>
                        <h4>Địa chỉ văn phòng</h4>
                        <p>123 Đường Nguyễn Huệ, Quận 1, TP. Hồ Chí Minh</p>
                    </div>
                </div>

                <div class="info-item">
                    <span class="icon">☎️</span>
                    <div>
                        <h4>Hotline / Zalo</h4>
                        <p><a href="tel:19001234">1900 1234</a></p>
                        <p><a href="https://zalo.me/19001234" target="_blank">Zalo: 1900 1234</a></p>
                    </div>
                </div>

                <div class="info-item">
                    <span class="icon">✉️</span>
                    <div>
                        <h4>Email</h4>
                        <p><a href="mailto:info@travel.vn">info@travel.vn</a></p>
                    </div>
                </div>

                <div class="info-item">
                    <span class="icon">🕒</span>
                    <div>
                        <h4>Giờ làm việc</h4>
                        <p>Thứ 2 - Chủ nhật: 8:00 - 22:00</p>
                    </div>
                </div>
            </div>

            <!-- Map -->
            <div class="map-container">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.123456789!2d106.699999!3d10.776999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTDCsDQ2JzM3LjAiTiAxMDbCsDQyJzAwLjAiRQ!5e0!3m2!1svi!2s!4v1234567890" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>

        <!-- RIGHT: Form liên hệ -->
        <div class="contact-form">
            <h2>Gửi tin nhắn cho chúng tôi</h2>

            <form id="contact-form" action="{{ route('contact.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="name">Họ và tên <span style="color:#ef4444">*</span></label>
                    <input type="text" id="name" name="name" required>
                </div>

                <div class="form-group">
                    <label for="email">Email <span style="color:#ef4444">*</span></label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="phone">Số điện thoại</label>
                    <input type="tel" id="phone" name="phone">
                </div>

                <div class="form-group">
                    <label for="subject">Tiêu đề</label>
                    <input type="text" id="subject" name="subject" placeholder="Ví dụ: Hỏi về tour Phú Quốc">
                </div>

                <div class="form-group">
                    <label for="message">Nội dung tin nhắn <span style="color:#ef4444">*</span></label>
                    <textarea id="message" name="message" required placeholder="Bạn cần hỗ trợ gì?"></textarea>
                </div>

                <button type="submit" class="btn-submit">Gửi tin nhắn</button>
            </form>
        </div>

    </div>

</div>

@endsection

@push('scripts')
<script>
// Form validation + success message (có thể kết hợp với Laravel validation)
document.getElementById('contact-form').addEventListener('submit', function(e) {
    // Bạn có thể thêm validation JS ở đây nếu cần
    console.log('Form submitted');
});
</script>
@endpush