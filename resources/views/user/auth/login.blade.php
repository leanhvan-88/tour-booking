@extends('layouts.user')

@section('content')
<div style="max-width: 520px; margin: 40px auto; padding: 20px;">
    <h2 style="font-size: 28px; font-weight: 700; margin-bottom: 12px;">Đăng nhập</h2>

    @if($errors->any())
        <div style="background:#fee2e2; color:#991b1b; padding:12px 16px; border-radius:10px; margin-bottom: 16px;">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('user.login.submit') }}" style="display:flex; flex-direction:column; gap: 12px;">
        @csrf

        <input type="email" name="email" value="{{ old('email') }}" placeholder="Email" required style="padding:12px 14px; border-radius:10px; border:1px solid #e5e7eb;">
        <input type="password" name="password" placeholder="Mật khẩu" required style="padding:12px 14px; border-radius:10px; border:1px solid #e5e7eb;">

        <button type="submit" style="padding:12px 14px; border-radius:10px; border:none; background:#0ea5e9; color:white; font-weight:600;">Đăng nhập</button>
    </form>

    <div style="margin-top: 14px;">
        Chưa có tài khoản? <a href="{{ route('user.register') }}">Đăng ký</a>
    </div>
</div>
@endsection
