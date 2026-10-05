<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة تحكم الإدمن - SanadkPro</title>
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
        .dashboard-header {
            background: white;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 30px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }
        .stats-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: all 0.3s;
            height: 100%;
        }
        .stats-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }
        .stats-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            font-size: 24px;
        }
        .stats-icon.hero {
            background: linear-gradient(135deg, #8b5cf6 0%, #a78bfa 100%);
            color: white;
        }
        .stats-icon.service {
            background: linear-gradient(135deg, #10b981 0%, #34d399 100%);
            color: white;
        }
        .stats-icon.whyus {
            background: linear-gradient(135deg, #3b82f6 0%, #60a5fa 100%);
            color: white;
        }
        .stats-icon.whous {
            background: linear-gradient(135deg, #f59e0b 0%, #fbbf24 100%);
            color: white;
        }
        .stats-icon.opinion {
            background: linear-gradient(135deg, #ef4444 0%, #f87171 100%);
            color: white;
        }
        .stats-icon.account {
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            color: white;
        }
        .stats-number {
            font-size: 32px;
            font-weight: 700;
            margin: 10px 0;
        }
        .stats-label {
            color: #64748b;
            font-size: 14px;
            font-weight: 600;
        }
        .quick-actions {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            margin-top: 30px;
        }
        .action-btn {
            background: #f1f5f9;
            border: none;
            padding: 15px;
            border-radius: 10px;
            text-align: center;
            display: block;
            width: 100%;
            transition: all 0.3s;
            color: #475569;
            font-weight: 600;
        }
        .action-btn:hover {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            color: white;
            transform: translateY(-3px);
        }
        .action-btn i {
            font-size: 24px;
            margin-bottom: 10px;
        }
        .welcome-box {
            background: linear-gradient(135deg, #2b6cb0 0%, #2c5282 100%);
            color: white;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 25px;
        }
        .welcome-box h3 {
            font-weight: 700;
            margin-bottom: 10px;
        }
        .btn-admin {
            background: linear-gradient(135deg, #d69e2e 0%, #ed8936 100%);
            border: none;
            color: white;
            padding: 12px 25px;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.3s;
        }
        .btn-admin:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(214, 158, 46, 0.3);
            color: white;
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
            .welcome-box {
                padding: 20px;
            }
            .stats-card {
                margin-bottom: 20px;
            }
        }

        @media (max-width: 576px) {
            .main-content {
                padding: 15px 12px;
            }
            .dashboard-header {
                padding: 15px;
            }
            .dashboard-header h1 {
                font-size: 1.2rem;
            }
            .stats-number {
                font-size: 24px;
            }
            .welcome-box h3 {
                font-size: 1.1rem;
            }
            .btn-admin {
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

        .row{
            margin:10px
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="logo">
            <h2><i class="fas fa-user-shield"></i> الأدمن</h2>
            <p>{{ auth()->guard('admin')->user()->name }}</p>
        </div>
        <nav class="nav flex-column mt-4">
            <div class="nav-item">
                <a class="nav-link active" href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-home"></i> لوحة التحكم
                </a>
            </div>
            <div class="nav-item">
                <a class="nav-link" href="{{ route('admin.auth.account') }}">
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
        <div class="dashboard-header">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="h3 mb-2">مرحباً، {{ auth()->guard('admin')->user()->name }}!</h1>
                    <p class="text-muted mb-0">لوحة تحكم الإدمن - إدارة موقع SanadkPro</p>
                </div>
                <div class="col-md-4 text-md-left mt-3 mt-md-0">
                    <div class="text-muted">
                        <i class="fas fa-calendar-alt"></i> {{ date('Y-m-d') }}
                        <span class="mx-2">•</span>
                        <i class="fas fa-clock"></i> {{ date('H:i') }}
                    </div>
                </div>
            </div>
        </div>
        
        @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        <div class="welcome-box">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h3><i class="fas fa-shield-alt"></i> منطقة الإدارة الآمنة</h3>
                    <p class="mb-0">أنت الآن في لوحة تحكم الإدمن الآمنة. يمكنك من هنا إدارة المحتوى وتعديل بيانات حسابك.</p>
                </div>
                <div class="col-md-4 text-md-left mt-3 mt-md-0">
                    <a href="{{ route('admin.auth.account') }}" class="btn-admin">
                        <i class="fas fa-user-cog"></i> إدارة الحساب
                    </a>
                </div>
            </div>
        </div>
        
           <div class="quick-actions">
            <h4 class="mb-4">الإجراءات السريعة</h4>
            <div class="row">
                <div class="col-md-3 mb-3">
                    <a href="{{ route('admin') }}" class="action-btn">
                        <i class="fas fa-edit"></i>
                        <div>تعديل المحتوى</div>
                    </a>
                </div>
                <div class="col-md-3 mb-3">
                    <a href="{{ route('admin.auth.account') }}" class="action-btn">
                        <i class="fas fa-key"></i>
                        <div>تغيير كلمة المرور</div>
                    </a>
                </div>
                <div class="col-md-3 mb-3">
                    <a href="{{ route('admin.auth.account') }}" class="action-btn">
                        <i class="fas fa-envelope"></i>
                        <div>تغيير البريد الإلكتروني</div>
                    </a>
                </div>
                <div class="col-md-3 mb-3">
                    <a href="{{ route('reviews') }}" class="action-btn">
                        <i class="fas fa-comments"></i>
                        <div>إدارة التعليقات</div>
                    </a>
                </div>
            </div>
        </div>
        

        <!--<div class="row">
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stats-card">
                    <div class="stats-icon hero">
                        <i class="fas fa-home"></i>
                    </div>
                    <div class="stats-number">{{ $hero ? '✓' : '✗' }}</div>
                    <div class="stats-label">الصفحة الرئيسية</div>
                    <small class="text-muted">محتويات الصفحة الرئيسية</small>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stats-card">
                    <div class="stats-icon service">
                        <i class="fas fa-concierge-bell"></i>
                    </div>
                    <div class="stats-number">{{ $service ? '✓' : '✗' }}</div>
                    <div class="stats-label">الخدمات</div>
                    <small class="text-muted">خدمات الشركة المتاحة</small>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stats-card">
                    <div class="stats-icon whyus">
                        <i class="fas fa-star"></i>
                    </div>
                    <div class="stats-number">{{ $whyus ? '✓' : '✗' }}</div>
                    <div class="stats-label">لماذا نحن</div>
                    <small class="text-muted">معلومات عن الشركة</small>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stats-card">
                    <div class="stats-icon whous">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stats-number">{{ $whous ? '✓' : '✗' }}</div>
                    <div class="stats-label">من نحن</div>
                    <small class="text-muted">معلومات فريق العمل</small>
                </div>
            </div>
        </div>-->
        
        <div class="row">
            <div class="col-lg-6 mb-4">
                <div class="stats-card">
                    <div class="stats-icon opinion">
                        <i class="fas fa-comments"></i>
                    </div>
                    <div class="stats-number">{{ $opinionsCount }}</div>
                    <div class="stats-label">التعليقات والآراء</div>
                    <small class="text-muted">عدد التعليقات في النظام</small>
                    <div class="mt-3">
                        <a href="{{ route('reviews') }}" class="btn-admin">
                            <i class="fas fa-eye"></i> عرض التعليقات
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6 mb-4">
                <div class="stats-card">
                    <div class="stats-icon account">
                        <i class="fas fa-user-shield"></i>
                    </div>
                    <div class="stats-number">1</div>
                    <div class="stats-label">حسابات الإدمن</div>
                    <small class="text-muted">عدد حسابات المشرفين</small>
                    <div class="mt-3">
                        <a href="{{ route('admin.auth.account') }}" class="btn-admin">
                            <i class="fas fa-cog"></i> إدارة الحساب
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
     
        <div class="alert alert-info mt-4">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h6><i class="fas fa-info-circle"></i> معلومات الأمان</h6>
                    <p class="mb-0">يجب عليك تحديث كلمة المرور بشكل دوري والحفاظ على سرية بيانات الدخول.</p>
                </div>
                <div class="col-md-4 text-md-left mt-3 mt-md-0">
                    <a href="{{ route('admin.auth.account') }}" class="btn-admin">
                        <i class="fas fa-shield-alt"></i> فحص أمان الحساب
                    </a>
                </div>
            </div>
        </div>
    </div>-->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Update time every minute
        function updateTime() {
            const now = new Date();
            const timeElement = document.querySelector('.fa-clock').parentElement;
            const timeString = now.getHours().toString().padStart(2, '0') + ':' + 
                              now.getMinutes().toString().padStart(2, '0');
            timeElement.innerHTML = `<i class="fas fa-clock"></i> ${timeString}`;
        }
        
        setInterval(updateTime, 60000);
        updateTime();
    </script>
</body>
</html>