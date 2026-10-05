<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إنشاء حساب إدمن - SanadkPro</title>
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
        .register-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            width: 100%;
            max-width: 450px;
            margin: auto;
        }
        .register-header {
            background: linear-gradient(135deg, #2b6cb0 0%, #2c5282 100%);
            color: white;
            padding: 25px;
            text-align: center;
        }
        .register-header h2 {
            margin: 0;
            font-weight: 700;
            font-size: 22px;
        }
        .register-header p {
            opacity: 0.9;
            margin: 8px 0 0;
            font-size: 14px;
        }
        .register-body {
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
        .btn-register {
            background: linear-gradient(135deg, #d69e2e 0%, #ed8936 100%);
            border: none;
            color: white;
            padding: 12px;
            border-radius: 8px;
            font-weight: 600;
            width: 100%;
            transition: all 0.3s;
        }
        .btn-register:hover {
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
        .password-hint {
            font-size: 13px;
            color: #718096;
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
        .links {
            margin-top: 15px;
        }
        .password-hint {
            font-size: 12px;
            color: #718096;
            margin-top: 5px;
        }
        .password-strength-meter {
            margin-top: 8px;
            height: 4px;
        }
        .password-strength-text {
            font-size: 11px;
            margin-top: 4px;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="register-header">
            <h2><i class="fas fa-user-shield"></i> إنشاء حساب إدمن</h2>
            <p>إنشاء حساب مشرف جديد للنظام</p>
        </div>
        
        <div class="register-body">
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

            <form method="POST" action="{{ route('admin.auth.register') }}">
                @csrf
                
                <div class="form-group">
                    <label for="name" class="form-label">الاسم</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                           id="name" name="name" value="{{ old('name') }}" required autofocus
                           placeholder="أدخل اسمك الكامل">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="email" class="form-label">البريد الإلكتروني</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                           id="email" name="email" value="{{ old('email') }}" required
                           placeholder="admin@example.com">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="password" class="form-label">كلمة المرور</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" 
                           id="password" name="password" required
                           oninput="checkPasswordStrength(this.value)">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    
                    <div class="password-strength-meter">
                        <div class="password-strength-fill" id="passwordStrengthFill"></div>
                    </div>
                    <div class="password-strength-text" id="passwordStrengthText"></div>
                    
                    <div class="password-hint">
                        <small class="text-muted"><i class="fas fa-info-circle"></i> يجب أن تكون كلمة المرور 8 أحرف على الأقل</small>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="password_confirmation" class="form-label">تأكيد كلمة المرور</label>
                    <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" 
                           id="password_confirmation" name="password_confirmation" required>
                    @error('password_confirmation')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <button type="submit" class="btn-register mb-3" id="submitBtn">
                    <i class="fas fa-user-plus"></i> إنشاء الحساب
                </button>
                
                <div class="links">
                    <p>لديك حساب بالفعل؟ <a href="{{ route('admin.auth.login') }}">تسجيل الدخول</a></p>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function checkPasswordStrength(password) {
            let strength = 0;
            const fillElement = document.getElementById('passwordStrengthFill');
            const textElement = document.getElementById('passwordStrengthText');
            const submitBtn = document.getElementById('submitBtn');
            
            // Check length
            if (password.length >= 8) {
                strength += 20;
            }
            
            // Check lowercase
            if (/[a-z]/.test(password)) {
                strength += 20;
            }
            
            // Check uppercase
            if (/[A-Z]/.test(password)) {
                strength += 20;
            }
            
            // Check numbers
            if (/[0-9]/.test(password)) {
                strength += 20;
            }
            
            // Check special characters
            if (/[^A-Za-z0-9]/.test(password)) {
                strength += 20;
            }
            
            // Update strength meter
            fillElement.style.width = strength + '%';
            
            // Update text and color
            if (password.length === 0) {
                textElement.textContent = '';
                fillElement.style.width = '0%';
            } else if (password.length < 8) {
                fillElement.className = 'password-strength-fill weak';
                textElement.textContent = 'ضعيفة (يجب أن تكون 8 أحرف على الأقل)';
                textElement.style.color = '#ef4444';
            } else if (strength <= 40) {
                fillElement.className = 'password-strength-fill weak';
                textElement.textContent = 'ضعيفة';
                textElement.style.color = '#ef4444';
            } else if (strength <= 60) {
                fillElement.className = 'password-strength-fill fair';
                textElement.textContent = 'متوسطة';
                textElement.style.color = '#f59e0b';
            } else if (strength <= 80) {
                fillElement.className = 'password-strength-fill good';
                textElement.textContent = 'جيدة';
                textElement.style.color = '#3b82f6';
            } else {
                fillElement.className = 'password-strength-fill strong';
                textElement.textContent = 'قوية جداً';
                textElement.style.color = '#10b981';
            }
            
            // Enable/disable submit button
            if (password.length >= 8) {
                submitBtn.disabled = false;
                submitBtn.style.opacity = '1';
            } else {
                submitBtn.disabled = true;
                submitBtn.style.opacity = '0.6';
            }
        }
        
        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            checkPasswordStrength('');
        });
    </script>
</body>
</html>