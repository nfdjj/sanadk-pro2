<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل دخول الإدمن - SanadkPro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #1a365d 0%, #2d3748 100%);
            min-height: 100vh;
            margin: 0;
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .login-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            width: 100%;
            max-width: 420px;
            margin: auto;
        }
        .login-header {
            background: linear-gradient(135deg, #2b6cb0 0%, #2c5282 100%);
            color: white;
            padding: 25px;
            text-align: center;
        }
        .login-header h2 {
            margin: 0;
            font-weight: 700;
            font-size: 22px;
        }
        .login-header p {
            opacity: 0.9;
            margin: 8px 0 0;
            font-size: 14px;
        }
        .login-body {
            padding: 30px;
        }
        .form-control {
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            padding: 10px 12px;
            transition: all 0.3s;
        }
        .form-control:focus {
            border-color: #2b6cb0;
            box-shadow: 0 0 0 3px rgba(43, 108, 176, 0.1);
        }
        .btn-login {
            background: linear-gradient(135deg, #d69e2e 0%, #ed8936 100%);
            border: none;
            color: white;
            padding: 12px;
            border-radius: 8px;
            font-weight: 600;
            width: 100%;
            transition: all 0.3s;
        }
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(214, 158, 46, 0.3);
        }
        .form-label {
            font-weight: 600;
            margin-bottom: 5px;
            font-size: 14px;
        }
        .alert {
            border-radius: 8px;
            border: none;
            padding: 12px;
            margin-bottom: 20px;
        }
        .password-strength-meter {
            margin-top: 10px;
            height: 5px;
            border-radius: 5px;
            background: #e2e8f0;
            overflow: hidden;
        }
        .password-strength-fill {
            height: 100%;
            width: 0%;
            transition: width 0.3s ease;
            border-radius: 5px;
        }
        .password-strength-text {
            font-size: 12px;
            margin-top: 5px;
            text-align: left;
        }
        .weak { background: #ef4444; }
        .fair { background: #f59e0b; }
        .good { background: #3b82f6; }
        .strong { background: #10b981; }
        .form-check-input:checked {
            background-color: #d69e2e;
            border-color: #d69e2e;
        }
        .links {
            margin-top: 20px;
            text-align: center;
        }
        .links a {
            color: #2b6cb0;
            text-decoration: none;
            font-weight: 600;
        }
        .links a:hover {
            text-decoration: underline;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .mb-3 {
            margin-bottom: 15px;
        }
        .links {
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <h2><i class="fas fa-lock"></i> منطقة الإدمن</h2>
            <p>تسجيل دخول خاص للمشرفين</p>
        </div>
        
        <div class="login-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('admin.auth.login') }}">
                @csrf
                
                <div class="form-group">
                    <label for="email" class="form-label">البريد الإلكتروني</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                           id="email" name="email" value="{{ old('email') }}" required autofocus
                           placeholder="admin@example.com">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="password" class="form-label">كلمة المرور</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" 
                           id="password" name="password" required>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="remember" name="remember">
                        <label class="form-check-label" for="remember">
                            تذكرني
                        </label>
                    </div>
                </div>
                
                <button type="submit" class="btn-login mb-3">
                    <i class="fas fa-sign-in-alt"></i> تسجيل الدخول
                </button>
                
                <div class="links">
                    <p>ليس لديك حساب؟ <a href="{{ route('admin.auth.register') }}">إنشاء حساب جديد</a></p>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>