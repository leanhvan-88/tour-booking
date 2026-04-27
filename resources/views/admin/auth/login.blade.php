<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập Admin - Travel</title>
    
    <style>
        :root {
            --primary: #0ea5e9;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', system-ui, sans-serif;
            background: linear-gradient(135deg, #0f172a 0%, #1e2937 100%);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #e2e8f0;
        }

        .login-container {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 24px;
            width: 100%;
            max-width: 420px;
            padding: 48px 40px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        }

        .logo {
            text-align: center;
            margin-bottom: 40px;
        }

        .logo span {
            color: var(--primary);
            font-weight: 700;
        }

        .login-container h2 {
            text-align: center;
            font-size: 28px;
            margin-bottom: 8px;
            color: white;
        }

        .subtitle {
            text-align: center;
            color: #94a3b8;
            margin-bottom: 40px;
            font-size: 15px;
        }

        .form-group {
            margin-bottom: 24px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            font-weight: 500;
            color: #cbd5e1;
        }

        .form-group input {
            width: 100%;
            padding: 16px 20px;
            background: rgba(255,255,255,0.1);
            border: 1px solid rgba(255,255,255,0.2);
            border-radius: 12px;
            color: white;
            font-size: 16px;
            transition: all 0.3s;
        }

        .form-group input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.2);
            background: rgba(255,255,255,0.12);
        }

        .form-group input::placeholder {
            color: #64748b;
        }

        .btn-login {
            width: 100%;
            padding: 16px;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 9999px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 10px;
        }

        .btn-login:hover {
            background: #0284c8;
            transform: translateY(-2px);
        }

        .error-message {
            background: rgba(239, 68, 68, 0.15);
            color: #fca5a5;
            padding: 14px 18px;
            border-radius: 12px;
            margin-bottom: 24px;
            font-size: 15px;
            border-left: 4px solid #ef4444;
        }

        .footer-text {
            text-align: center;
            margin-top: 30px;
            font-size: 14px;
            color: #64748b;
        }

        @media (max-width: 480px) {
            .login-container {
                padding: 32px 24px;
                margin: 0 16px;
            }
        }
    </style>
</head>
<body>

    <div class="login-container">
        <!-- Logo -->
        <div class="logo">
            <h1 style="font-size: 32px; color: white;">Travel<span>.</span></h1>
            <p style="color: #64748b; font-size: 14px; margin-top: 4px;">Admin Panel</p>
        </div>

        <h2>Đăng nhập quản trị</h2>
        <p class="subtitle">Vui lòng nhập thông tin tài khoản admin</p>

        @if ($errors->any())
            <div class="error-message">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.login.submit') }}">
            @csrf

            <div class="form-group">
                <label for="email">Email đăng nhập</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    placeholder="admin@travel.vn" 
                    value="{{ old('email') }}"
                    required 
                    autofocus>
            </div>

            <div class="form-group">
                <label for="password">Mật khẩu</label>
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    placeholder="••••••••" 
                    required>
            </div>

            <button type="submit" class="btn-login">
                Đăng nhập
            </button>
        </form>

        <div class="footer-text">
            © {{ date('Y') }} Travel. All rights reserved.
        </div>
    </div>

</body>
</html>