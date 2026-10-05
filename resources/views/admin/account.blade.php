<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إدارة حساب الإدمن - SanadkPro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: #f8fafc;
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .sidebar {
            background: linear-gradient(135deg, #1a365d 0%, #2d3748 100%);
            color: white;
            min-height: 100vh;
            position: fixed;
            right: 0;
            top: 0;
            width: 280px;
            box-shadow: 5px 0 20px rgba(0, 0, 0, 0.2);
        }
        .main-content {
            margin-right: 280px;
            padding: 30px;
        }
        .logo {
            padding: 30px;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        .logo h2 {
            margin: 0;
            font-weight: 700;
        }
        .logo p {
            opacity: 0.8;
            margin: 5px 0 0;
            font-size: 14px;
        }
        .nav-item {
            margin: 5px 15px;
        }
        .nav-link {
            color: rgba(255, 255, 255, 0.8);
            padding: 12px 20px;
            border-radius: 10px;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .nav-link:hover {
            color: white;
            background: rgba(255, 255, 255, 0.1);
        }
        .nav-link.active {
            color: white;
            background: linear-gradient(135deg, #d69e2e 0%, #ed8936 100%);
        }
        .nav-link i {
            width: 20px;
        }
        .account-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-bottom: 30px;
            border: none;
        }
        .card-title {
            color: #1e293b;
            font-weight: 700;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid #f1f5f9;
        }
        .form-control {
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            padding: 12px 15px;
            transition: all 0.3s;
        }
        .form-control:focus {
            border-color: #2b6cb0;
            box-shadow: 0 0 0 3px rgba(43, 108, 176, 0.1);
        }
        .btn-primary {
            background: linear-gradient(135deg, #d69e2e 0%, #ed8936 100%);
            border: none;
            padding: 12px 25px;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.3s;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(214, 158, 46, 0.3);
        }
        .btn-danger {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            border: none;
            padding: 12px 25px;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.3s;
        }
        .btn-danger:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(239, 68, 68, 0.3);
        }
        .alert {
            border-radius: 10px;
            border: none;
            padding: 15px;
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
        .info-box {
            background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
        }
        .info-box h6 {
            color: #475569;
            font-weight: 600;
            margin-bottom: 10px;
        }
        .info-box p {
            color: #64748b;
            margin: 0;
        }
        .nav-tabs {
            border-bottom: 2px solid #e2e8f0;
            margin-bottom: 30px;
        }
        .nav-tabs .nav-link {
            border: none;
            color: #64748b;
            font-weight: 600;
            padding: 10px 20px;
            margin: 0 5px;
            border-radius: 10px 10px 0 0;
        }
        .nav-tabs .nav-link.active {
            color: #4f46e5;
            background: transparent;
            border-bottom: 3px solid #4f46e5;
        }
        .tab-content {
            padding: 20px 0;
        }

        /* Mobile Responsive */
        @media (max-width: 991px) {
            .sidebar {
                position: relative;
                width: 100%;
                min-height: auto;
                right: auto;
                box-shadow: none;
                padding-bottom: 10px;
            }
            .main-content {
                margin-right: 0;
                padding: 20px 15px;
            }
            .sidebar .logo {
                padding: 15px;
            }
            .sidebar .nav {
                flex-direction: row;
                flex-wrap: wrap;
                justify-content: center;
                margin-top: 0 !important;
            }
            .sidebar .nav-item {
                margin: 5px;
            }
            .sidebar .nav-link {
                padding: 8px 14px;
                font-size: 0.85rem;
            }
            .sidebar .nav-item.mt-4 {
                margin-top: 5px !important;
            }
            .sidebar .nav-item.mt-4 form {
                margin: 0;
            }
            .sidebar .nav-item.mt-4 .nav-link {
                width: auto !important;
                text-align: center !important;
            }
            .account-card {
                padding: 20px;
            }
        }

        @media (max-width: 576px) {
            .main-content {
                padding: 15px 12px;
            }
            .account-card {
                padding: 15px;
            }
            .card-title {
                font-size: 1.1rem;
            }
            .btn-primary,
            .btn-danger {
                padding: 10px 18px;
                font-size: 0.85rem;
            }
            .sidebar .nav-link {
                font-size: 0.75rem;
                padding: 7px 10px;
            }
            .sidebar .nav-link i {
                width: 16px;
                font-size: 0.85rem;
            }
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="logo">
            <h2><i class="fas fa-user-shield"></i> الإدمن</h2>
            <p>{{ auth()->guard('admin')->user()->name }}</p>
        </div>
        <nav class="nav flex-column mt-4">
            <div class="nav-item">
                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-home"></i> لوحة التحكم
                </a>
            </div>
            <div class="nav-item">
                <a class="nav-link active" href="{{ route('admin.auth.account') }}">
                    <i class="fas fa-user-cog"></i> إدارة الحساب
                </a>
            </div>
            <div class="nav-item">
                <a class="nav-link" href="{{ route('admin') }}">
                    <i class="fas fa-tachometer-alt"></i> إدارة المحتوى
                </a>
            </div>
            <div class="nav-item mt-4">
                <form method="POST" action="{{ route('admin.auth.logout') }}">
                    @csrf
                    <button type="submit" class="nav-link" style="background: transparent; border: none; width: 100%; text-align: right;">
                        <i class="fas fa-sign-out-alt"></i> تسجيل الخروج
                    </button>
                </form>
            </div>
        </nav>
    </div>
    
    <div class="main-content">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0">إدارة حساب الإدمن</h1>
            <div class="text-muted">
                آخر دخول: {{ auth()->guard('admin')->user()->updated_at->diffForHumans() }}
            </div>
        </div>
        
        @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <div><i class="fas fa-exclamation-circle"></i> {{ $error }}</div>
                @endforeach
            </div>
        @endif
        
        <div class="row">
            <div class="col-lg-8">
                <div class="account-card">
                    <h4 class="card-title">تغيير كلمة المرور</h4>
                    
                    <form method="POST" action="{{ route('admin.auth.update.password') }}">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-4">
                            <label for="current_password" class="form-label">كلمة المرور الحالية</label>
                            <input type="password" class="form-control @error('current_password') is-invalid @enderror" 
                                   id="current_password" name="current_password" required>
                            @error('current_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="new_password" class="form-label">كلمة المرور الجديدة</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                   id="new_password" name="password" required
                                   oninput="checkPasswordStrength(this.value)">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            
                            <div class="password-strength-meter mt-3">
                                <div class="password-strength-fill" id="passwordStrengthFill"></div>
                            </div>
                            <div class="password-strength-text" id="passwordStrengthText"></div>
                        </div>
                        
                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label">تأكيد كلمة المرور الجديدة</label>
                            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" 
                                   id="password_confirmation" name="password_confirmation" required>
                            @error('password_confirmation')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <button type="submit" class="btn-primary" id="submitBtn">
                            <i class="fas fa-key"></i> تحديث كلمة المرور
                        </button>
                    </form>
                </div>
                
                <div class="account-card">
                    <h4 class="card-title">تغيير البريد الإلكتروني</h4>
                    
                    <form method="POST" action="{{ route('admin.auth.update.email') }}">
                        @csrf
                        @method('PUT')
                        
                        <div class="info-box">
                            <h6>البريد الإلكتروني الحالي</h6>
                            <p>{{ auth()->guard('admin')->user()->email }}</p>
                            @if(auth()->guard('admin')->user()->email_verified_at)
                                <span class="badge bg-success"><i class="fas fa-check-circle"></i> تم التحقق</span>
                            @else
                                <span class="badge bg-warning"><i class="fas fa-exclamation-circle"></i> لم يتم التحقق</span>
                            @endif
                        </div>
                        
                        <div class="mb-4">
                            <label for="email" class="form-label">البريد الإلكتروني الجديد</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                   id="email" name="email" value="{{ old('email') }}" required
                                   placeholder="new-email@example.com">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="password_for_email" class="form-label">كلمة المرور الحالية للتأكيد</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                   id="password_for_email" name="password" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <button type="submit" class="btn-primary">
                            <i class="fas fa-envelope"></i> تحديث البريد الإلكتروني
                        </button>
                    </form>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="account-card">
                    <h4 class="card-title">معلومات الحساب</h4>
                    
                    <div class="info-box">
                        <h6>الاسم</h6>
                        <p>{{ auth()->guard('admin')->user()->name }}</p>
                    </div>
                    
                    <div class="info-box">
                        <h6>البريد الإلكتروني</h6>
                        <p>{{ auth()->guard('admin')->user()->email }}</p>
                    </div>
                    
                    <div class="info-box">
                        <h6>تاريخ إنشاء الحساب</h6>
                        <p>{{ auth()->guard('admin')->user()->created_at->format('Y-m-d H:i:s') }}</p>
                    </div>
                    
                    <div class="info-box">
                        <h6>آخر تحديث</h6>
                        <p>{{ auth()->guard('admin')->user()->updated_at->format('Y-m-d H:i:s') }}</p>
                    </div>
                    
                    <div class="info-box">
                        <h6>حالة التحقق</h6>
                        @if(auth()->guard('admin')->user()->email_verified_at)
                            <p><span class="badge bg-success"><i class="fas fa-check-circle"></i> تم التحقق من البريد</span></p>
                            <small class="text-muted">تم التحقق في: {{ auth()->guard('admin')->user()->email_verified_at->format('Y-m-d H:i:s') }}</small>
                        @else
                            <p><span class="badge bg-warning"><i class="fas fa-exclamation-circle"></i> لم يتم التحقق من البريد</span></p>
                            <small class="text-muted">يجب التحقق من البريد الإلكتروني</small>
                        @endif
                    </div>
                    
                    <div class="mt-4">
                        <form method="POST" action="{{ route('admin.auth.logout') }}">
                            @csrf
                            <button type="submit" class="btn-danger w-100">
                                <i class="fas fa-sign-out-alt"></i> تسجيل الخروج من جميع الجلسات
                            </button>
                        </form>
                    </div>
                </div>
                
                <div class="account-card">
                    <h4 class="card-title">نصائح الأمان</h4>
                    <div class="info-box">
                        <p><i class="fas fa-shield-alt text-primary"></i> استخدم كلمة مرور قوية تحتوي على أحرف كبيرة وصغيرة وأرقام ورموز</p>
                        <p><i class="fas fa-sync-alt text-primary"></i> غير كلمة المرور بشكل دوري كل 3 أشهر</p>
                        <p><i class="fas fa-envelope text-primary"></i> تأكد من صحة البريد الإلكتروني لاستقبال التنبيهات</p>
                        <p><i class="fas fa-lock text-primary"></i> لا تشارك بيانات الدخول مع أي شخص</p>
                    </div>
                </div>
            </div>
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
            if (strength <= 20) {
                fillElement.className = 'password-strength-fill weak';
                textElement.textContent = 'ضعيفة جداً';
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
            if (strength >= 80 && password.length >= 8) {
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