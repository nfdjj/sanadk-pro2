<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>إدارة آراء العملاء | سندك برو</title>
    <link rel="stylesheet" href="{{ asset('styles.css') }}">
    <link rel="stylesheet" href="{{ asset('admin.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="rtl">
    <nav class="navbar">
        <div class="nav-container">
            <div class="logo">
                <h2><span class="logo-main">سندك</span> <span class="logo-accent">برو</span></h2>
            </div>
            <ul class="nav-menu">
                <li><a href="{{ url('/') }}">الموقع الرئيسي</a></li>
                <li><a href="{{ url('/admin-secure-x7K9mP2qL5nR8') }}">لوحة التحكم</a></li>
                <li><a href="#reviews-table">إدارة الآراء</a></li>
                <li><a href="{{ url('/') }}" class="logout-btn">تسجيل خروج</a></li>
            </ul>
            <div class="hamburger">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </nav>

    <!-- قسم إدارة الآراء -->
    <section id="reviews-table" class="admin-reviews">
        <div class="container">
            <h1><i class="fas fa-comments"></i> إدارة آراء العملاء</h1>
            <p class="admin-subtitle">عرض وإدارة جميع تقييمات العملاء</p>
            
            <div class="reviews-stats">
                <div class="review-stat-card">
                    <i class="fas fa-comment-alt"></i>
                    <div>
                        <h3>إجمالي الآراء</h3>
                        <p id="reviews-total">{{ $opinionsCount ?? 0 }}</p>
                    </div>
                </div>
                <a href="{{ url('/admin-secure-x7K9mP2qL5nR8') }}" class="back-link">
                    <i class="fas fa-arrow-right"></i> العودة إلى لوحة التحكم
                </a>
            </div>

            @if(session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i>
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-error">
                    <i class="fas fa-exclamation-circle"></i>
                    {{ session('error') }}
                </div>
            @endif
            
            <!-- جدول الآراء -->
            <div class="admin-table-container">
                <h2><i class="fas fa-table"></i> جميع آراء العملاء</h2>
                <div class="table-responsive">
                    <table class="admin-table reviews-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>اسم العميل</th>
                                <th>التقييم</th>
                                <th>الرأي</th>
                                <th>التاريخ</th>
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody id="reviews-table-body">
@forelse($opinions as $index => $review)
                                
                                <tr id="review-row-{{ $review->id }}">
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $review->name }}</td>
                                    <td>
                                        <span class="stars">{{ str_repeat('★', $review->rating ?? 0) }}{{ str_repeat('☆', 5 - ($review->rating ?? 0)) }}</span>
                                        <span class="rating-number">({{ $review->rating ?? 0 }}/5)</span>
                                    </td>
                                    <td>{{ $review->opinion }}</td>
                                    <td>{{ optional($review->created_at)->format('Y-m-d') }}</td>
                                    <td class="review-actions">
                                        <a href="{{ url('/') }}#customer-reviews?review_id={{ $review->id }}" class="action-btn view-btn" style="margin-inline-end:8px; display:inline-flex; align-items:center; gap:6px; text-decoration:none;">
                                            <i class="fas fa-eye"></i> عرض
                                        </a>

                                        @if(($review->approval_status ?? 'pending') !== 'approved')
                                            <form method="POST" action="{{ url('/opinions/'.$review->id.'/approve') }}" class="review-approve-form" style="display:inline-block; margin-inline-start:6px;">
                                                @csrf
                                                <input type="hidden" name="approval_status" value="approved">
                                                <button type="submit" class="action-btn approve-btn" style="background:#28a745; border:none; padding:10px 14px; border-radius:8px; color:#fff; cursor:pointer;">
                                                    <i class="fas fa-check"></i> موافقة
                                                </button>
                                            </form>
                                        @else
                                            <span style="display:inline-block; margin-inline-start:6px; color:#28a745; font-weight:700;">
                                                <i class="fas fa-check-circle"></i> معتمد
                                            </span>
                                        @endif

                                        <form method="POST" action="{{ url('/opinions/'.$review->id) }}" class="review-delete-form" data-id="{{ $review->id }}" style="display:inline-block; margin-inline-start:6px;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="action-btn delete-btn">
                                                <i class="fas fa-trash"></i> حذف
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" style="text-align: center; padding: 40px;">
                                        <i class="fas fa-comment-slash" style="font-size: 2.5rem; color: #a7b2c0; margin-bottom: 15px;"></i>
                                        <p style="color: #a7b2c0; font-size: 1.1rem;">لا توجد آراء بعد</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <footer class="footer">
        <div class="container">
            <p class="footer-desc">إدارة آراء العملاء - سندك برو &copy; 2026</p>
            <p>جميع الحقوق محفوظة | نسخة النظام 1.0.0</p>
        </div>
    </footer>

    <div id="adminDeleteMessage" style="display:none; position: fixed; top: 80px; left: 50%; transform: translateX(-50%); z-index: 3000;">
    </div>

    <!-- Confirm Modal -->
    <div id="confirmModal" class="modal" style="display:none;">
        <div class="modal-content">
            <div class="modal-header">
                <h2>تأكيد الحذف</h2>
                <button class="close-btn" id="confirmCancel">×</button>
            </div>
            <div class="modal-body">
                <p id="confirmModalMessage">هل أنت متأكد من حذف هذا الرد؟</p>
                <div class="form-actions" style="justify-content:flex-start; margin-top:20px;">
                    <button id="confirmOk" class="save-btn">نعم، احذف</button>
                    <button id="confirmCancelBtn" class="cancel-btn">إلغاء</button>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('script.js') }}"></script>
</body>
</html>