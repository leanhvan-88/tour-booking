@extends('layouts.user')

@section('content')

<!-- FLATPICKR CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

<div class="container">

    <div class="booking-layout">

        <!-- LEFT: TOUR INFO -->
        <div class="tour-info">

            <img src="{{ $tour->image }}" class="tour-img">

            <h2>{{ $tour->name }}</h2>

            <p class="route">
                {{ $tour->departure }} → {{ $tour->destination }}
            </p>

            <p class="price" id="price">
                {{ number_format($tour->price) }}đ
            </p>

            <p class="duration">
                ⏱ {{ $tour->duration }} ngày
            </p>

            <hr>

            <p>Tổng tiền:</p>
            <h2 id="totalPrice">0đ</h2>

        </div>

        <!-- RIGHT: FORM -->
        <div class="form-box">

            <h3>Thông tin đặt tour</h3>

            @if($errors->any())
                <div class="error">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('booking.store') }}" id="bookingForm">
                @csrf

                <input type="hidden" name="tour_id" value="{{ $tour->id }}">

                <!-- NAME -->
                <div class="input-group">
                    <input type="text" name="full_name" required placeholder=" ">
                    <label>Họ và tên</label>
                </div>

                <!-- PHONE -->
                <div class="input-group">
                    <input type="text" name="phone" required placeholder=" ">
                    <label>Số điện thoại</label>
                </div>

                <!-- EMAIL -->
                <div class="input-group">
                    <input type="email" name="email" required placeholder=" ">
                    <label>Email</label>
                </div>

                <!-- DATE PICKER -->
                <div class="input-group">
                    <input type="text" id="datePicker" name="departure_date" required placeholder=" ">
                    <label>Ngày khởi hành</label>
                </div>

                <!-- PEOPLE -->
                <div class="row">

                    <div class="input-group">
                        <input type="number" id="adult" name="adult_count" value="1" min="1" placeholder=" ">
                        <label>Người lớn</label>
                    </div>

                    <div class="input-group">
                        <input type="number" id="child" name="child_count" value="0" min="0" placeholder=" ">
                        <label>Trẻ em</label>
                    </div>

                </div>

                <!-- NOTE -->
                <div class="input-group">
                    <textarea name="message" rows="3" placeholder=" "></textarea>
                    <label>Ghi chú</label>
                </div>

                <button type="submit" class="btn-book">
                    Xác nhận đặt tour
                </button>

            </form>

        </div>

    </div>

</div>

<style>

.container {
    max-width:1100px;
    margin:auto;
    padding:40px 20px;
}

.booking-layout {
    display:grid;
    grid-template-columns: 1fr 1fr;
    gap:30px;
}

.tour-info {
    background:#0f172a;
    padding:20px;
    border-radius:16px;
}

.tour-img {
    width:100%;
    height:200px;
    object-fit:cover;
    border-radius:12px;
}

.price {
    font-size:22px;
    color:#22c55e;
}

.form-box {
    background:#0f172a;
    padding:25px;
    border-radius:16px;
}

.input-group {
    position:relative;
    margin-bottom:20px;
}

.input-group input,
.input-group textarea {
    width:100%;
    padding:12px;
    background:#020617;
    border:1px solid #334155;
    border-radius:8px;
    color:white;
}

.input-group label {
    position:absolute;
    left:12px;
    top:12px;
    color:#64748b;
    transition:0.3s;
}

.input-group input:focus + label,
.input-group input:not(:placeholder-shown) + label,
.input-group textarea:focus + label,
.input-group textarea:not(:placeholder-shown) + label {
    top:-8px;
    left:8px;
    font-size:12px;
    background:#0f172a;
}

.row {
    display:flex;
    gap:10px;
}

.btn-book {
    width:100%;
    background:#06b6d4;
    padding:12px;
    border-radius:10px;
    font-weight:bold;
}

.error {
    background:#ef4444;
    padding:10px;
    margin-bottom:15px;
    border-radius:8px;
}

</style>

<!-- FLATPICKR JS -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script>

// DATE PICKER
flatpickr("#datePicker", {
    minDate: "today",
    dateFormat: "Y-m-d",
    altInput: true,
    altFormat: "d/m/Y",
});

// PRICE CALCULATION
const price = {{ $tour->price ?? 0 }};
const adult = document.getElementById('adult');
const child = document.getElementById('child');
const total = document.getElementById('totalPrice');

function calcTotal() {
    let totalMoney = (adult.value * price) + (child.value * price * 0.5);
    total.innerHTML = totalMoney.toLocaleString() + "đ";
}

adult.addEventListener('input', calcTotal);
child.addEventListener('input', calcTotal);

calcTotal();

// LOADING
document.getElementById('bookingForm').addEventListener('submit', function(){
    document.querySelector('.btn-book').innerHTML = 'Đang xử lý...';
});

</script>

@endsection