<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>لوحة تحكم المدير | سندك برو</title>
    <link rel="stylesheet" href="{{ asset('styles.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('admin.css') }}?v={{ time() }}">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .admin-nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
        }
        .admin-nav-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }
        .admin-user {
            color: white;
            font-weight: 600;
        }
        .admin-logout-btn {
            background: transparent;
            border: 2px solid rgba(255, 255, 255, 0.3);
            color: white;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s;
        }
        .admin-logout-btn:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 255, 255, 0.5);
        }
    </style>
</head>
<body class="rtl">
    <nav class="navbar">
        <div class="nav-container admin-nav">
            <div class="logo">
                <h2><span class="logo-main">سندك</span> <span class="logo-accent">برو</span></h2>
            </div>
            <div class="admin-nav-right">
                @auth('admin')
                <div class="admin-user">
                    <i class="fas fa-user-shield"></i> {{ auth()->guard('admin')->user()->name }}
                </div>
                <form method="POST" action="{{ route('admin.auth.logout') }}">
                    @csrf
                    <button type="submit" class="admin-logout-btn">
                        <i class="fas fa-sign-out-alt"></i> تسجيل خروج
                    </button>
                </form>
                @endauth
                <ul class="nav-menu">
                    <li><a href="{{ url('/') }}">الموقع الرئيسي</a></li>
                    <li><a href="#dashboard">لوحة التحكم</a></li>
                    <li><a href="{{ url('/reviews') }}">إدارة الآراء</a></li>
                </ul>
            </div>
            <div class="hamburger">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </nav>

    <!-- لوحة التحكم -->
    <section id="dashboard" class="admin-dashboard">
        <div class="container">
            <h1><i class="fas fa-tachometer-alt"></i> لوحة تحكم المدير</h1>
            <p class="admin-subtitle">إدارة محتويات موقع سندك برو</p>

            <div class="admin-stats">
                <a href="{{ url('/reviews') }}" class="stat-card-link">
                    <div class="stat-card clickable">
                        <div class="stat-icon">
                            <i class="fas fa-comments"></i>
                        </div>
                        <div class="stat-info">
                            <h3>إجمالي الآراء</h3>
                            <p id="total-reviews">{{ $opinionsCount ?? 0 }}</p>
                            <p class="stat-link">انقر لعرض جميع الآراء <i class="fas fa-arrow-left"></i></p>
                        </div>
                    </div>
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
            <div id="adminDeleteMessage" style="display:none; position: fixed; top: 80px; left: 50%; transform: translateX(-50%); z-index: 3000;"></div>

            <div class="admin-table-container">
                <h2><i class="fas fa-table"></i> الأقسام المتاحة</h2>
                <div class="table-responsive">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>اسم القسم</th>
                                <th>الوصف</th>
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td data-label="#">1</td>
                                <td data-label="اسم القسم">القسم الرئيسي</td>
                                <td data-label="الوصف">العنوان والمحتوى في الصفحة الرئيسية</td>
                                <td data-label="الإجراءات" class="actions-cell">
                                        <button type="button" class="action-btn edit-btn section-edit-btn" data-target="hero">تعديل</button>
                                </td>
                            </tr>
                            <tr>
                                <td data-label="#">2</td>
                                <td data-label="اسم القسم">قسم الخدمات</td>
                                <td data-label="الوصف">نصوص وأزرار وصف الخدمات</td>
                                <td data-label="الإجراءات" class="actions-cell">
                                        <button type="button" class="action-btn edit-btn section-edit-btn" data-target="service">تعديل</button>
                                </td>
                            </tr>
                            <tr>
                                <td data-label="#">3</td>
                                <td data-label="اسم القسم">قسم لماذا نحن</td>
                                <td data-label="الوصف">العناوين والنقاط التي تبرز المزايا</td>
                                <td data-label="الإجراءات" class="actions-cell">
                                        <button type="button" class="action-btn edit-btn section-edit-btn" data-target="whyus">تعديل</button>
                                </td>
                            </tr>
                            <tr>
                                <td data-label="#">4</td>
                                <td data-label="اسم القسم">قسم من نحن</td>
                                <td data-label="الوصف">النصوص التعريفية عن الشركة ورسالتها</td>
                                <td data-label="الإجراءات" class="actions-cell">
                                        <button type="button" class="action-btn edit-btn section-edit-btn" data-target="whous">تعديل</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="section-selected-notice" id="section-selected-notice">
                <p>اختر أحد الأقسام أعلاه لعرض نموذج التعديل.</p>
            </div>

            <div class="admin-sections-grid" id="admin-sections-grid">
                <article class="admin-card section-card hidden" id="section-card-hero">
                    <div class="card-header">
                        <h2><i class="fas fa-home"></i> القسم الرئيسي</h2>
                        <p>العنوان والمحتوى في الصفحة الرئيسية.</p>
                    </div>
                    <form method="POST" action="{{ url('/hero') }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="hero_title_ar">العنوان بالعربية</label>
                            <input id="hero_title_ar" name="title_ar" value="{{ old('title_ar', optional($hero)->title_ar) }}" />
                        </div>
                        <div class="form-group">
                            <label for="hero_title_en">العنوان بالإنجليزية</label>
                            <input id="hero_title_en" name="title_en" value="{{ old('title_en', optional($hero)->title_en) }}" />
                        </div>
                        <div class="form-group">
                            <label for="hero_content_ar">المحتوى بالعربية</label>
                            <textarea id="hero_content_ar" name="content_ar" rows="4">{{ old('content_ar', optional($hero)->content_ar) }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="hero_content_en">المحتوى بالإنجليزية</label>
                            <textarea id="hero_content_en" name="content_en" rows="4">{{ old('content_en', optional($hero)->content_en) }}</textarea>
                        </div>

                        <h3 class="section-subtitle">معلومات التواصل</h3>
                        <div class="form-group">
                            <label for="hero_whatsapp_number">رقم الواتساب (لزر "تواصل معنا")</label>
                            <input type="text" id="hero_whatsapp_number" name="whatsapp_number" 
                                   value="{{ old('whatsapp_number', optional($hero)->whatsapp_number ?? '966500881876') }}"
                                   placeholder="مثال: 966500881876">
                            <small class="text-muted">يستخدم لزر "تواصل معنا" في قسم الهيرو</small>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="save-btn"><i class="fas fa-save"></i> حفظ القسم</button>
                        </div>
                    </form>
                </article>

                <article class="admin-card section-card hidden" id="section-card-service">
                    <div class="card-header">
                        <h2><i class="fas fa-briefcase"></i> قسم الخدمات</h2>
                        <p>النص الرئيسي وخدمتين ثابتتين.</p>
                    </div>
                    <form method="POST" action="{{ url('/service') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="service_main_text_ar">النص الرئيسي بالعربية</label>
                            <textarea id="service_main_text_ar" name="main_text_ar" rows="3">{{ old('main_text_ar', optional($service)->main_text_ar) }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="service_main_text_en">النص الرئيسي بالإنجليزية</label>
                            <textarea id="service_main_text_en" name="main_text_en" rows="3">{{ old('service_main_text_en', optional($service)->main_text_en) }}</textarea>
                        </div>

                        <h3 class="section-subtitle">الخدمة الأولى</h3>
                        <div class="form-group">
                            <label for="service_image">صورة الخدمة الأولى</label>
                            @if(optional($service)->service_image)
                                <div class="current-image" style="margin-bottom: 10px;">
                                    <img src="{{ asset(optional($service)->service_image) }}" alt="Current Image" style="max-height: 80px; border-radius: 4px;" />
                                </div>
                            @endif
                            <input type="file" id="service_image" name="service_image" accept="image/*" />
                        </div>
                        <div class="form-group">
                            <label for="service_title_text_ar">عنوان الخدمة الأولى بالعربية</label>
                            <input id="service_title_text_ar" name="title_text_ar" value="{{ old('title_text_ar', optional($service)->title_text_ar) }}" />
                        </div>
                        <div class="form-group">
                            <label for="service_title_text_en">عنوان الخدمة الأولى بالإنجليزية</label>
                            <input id="service_title_text_en" name="title_text_en" value="{{ old('title_text_en', optional($service)->title_text_en) }}" />
                        </div>
                        <div class="form-group">
                            <label for="service_description_text_ar">الوصف الفرعي للخدمة الأولى بالعربية</label>
                            <textarea id="service_description_text_ar" name="description_text_ar" rows="3">{{ old('description_text_ar', optional($service)->description_text_ar) }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="service_description_text_en">الوصف الفرعي للخدمة الأولى بالإنجليزية</label>
                            <textarea id="service_description_text_en" name="description_text_en" rows="3">{{ old('description_text_en', optional($service)->description_text_en) }}</textarea>
                        </div>

                        <h3 class="section-subtitle">الخدمة الثانية</h3>
                        <div class="form-group">
                            <label for="service_image2">صورة الخدمة الثانية</label>
                            @if(optional($service)->service_image2)
                                <div class="current-image" style="margin-bottom: 10px;">
                                    <img src="{{ asset(optional($service)->service_image2) }}" alt="Current Image" style="max-height: 80px; border-radius: 4px;" />
                                </div>
                            @endif
                            <input type="file" id="service_image2" name="service_image2" accept="image/*" />
                        </div>
                        <div class="form-group">
                            <label for="service_title_text2_ar">عنوان الخدمة الثانية بالعربية</label>
                            <input id="service_title_text2_ar" name="title_text2_ar" value="{{ old('title_text2_ar', optional($service)->title_text2_ar) }}" />
                        </div>
                        <div class="form-group">
                            <label for="service_title_text2_en">عنوان الخدمة الثانية بالإنجليزية</label>
                            <input id="service_title_text2_en" name="title_text2_en" value="{{ old('title_text2_en', optional($service)->title_text2_en) }}" />
                        </div>
                        <div class="form-group">
                            <label for="service_description_text2_ar">الوصف الفرعي للخدمة الثانية بالعربية</label>
                            <textarea id="service_description_text2_ar" name="description_text2_ar" rows="3">{{ old('description_text2_ar', optional($service)->description_text2_ar) }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="service_description_text2_en">الوصف الفرعي للخدمة الثانية بالإنجليزية</label>
                            <textarea id="service_description_text2_en" name="description_text2_en" rows="3">{{ old('service_description_text2_en', optional($service)->description_text2_en) }}</textarea>
                        </div>

                        <h3 class="section-subtitle">معلومات التواصل</h3>
                        <div class="form-group">
                            <label for="service_whatsapp_number">رقم الواتساب</label>
                            <input type="text" id="service_whatsapp_number" name="whatsapp_number" 
                                   value="{{ old('whatsapp_number', optional($service)->whatsapp_number ?? '966500881876') }}"
                                   placeholder="مثال: 966500881876">
                            <small class="text-muted">يستخدم للأزرار في جميع أنحاء الموقع</small>
                        </div>
                        
                        <div class="form-group">
                            <label for="service_phone_number">رقم الهاتف</label>
                            <input type="text" id="service_phone_number" name="phone_number" 
                                   value="{{ old('phone_number', optional($service)->phone_number ?? '+966500881876') }}"
                                   placeholder="مثال: +966500881876">
                            <small class="text-muted">يستخدم للأزرار في جميع أنحاء الموقع</small>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="save-btn"><i class="fas fa-save"></i> حفظ القسم</button>
                        </div>
                    </form>
                </article>

                <article class="admin-card section-card hidden" id="section-card-whyus">
                    <div class="card-header">
                        <h2><i class="fas fa-question-circle"></i> قسم لماذا نحن</h2>
                        <p>تعديل العنوان الرئيسي فقط (لماذا يثق بنا عملاؤنا؟).</p>
                    </div>
                    <form method="POST" action="{{ url('/whyus') }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="whyus_main_text_ar">العنوان الرئيسي بالعربية (لماذا يثق بنا عملاؤنا؟)</label>
                            <textarea id="whyus_main_text_ar" name="main_text_ar" rows="3">{{ old('main_text_ar', optional($whyus)->main_text_ar) }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="whyus_main_text_en">العنوان الرئيسي بالإنجليزية (Why Do Our Clients Trust Us?)</label>
                            <textarea id="whyus_main_text_en" name="main_text_en" rows="3">{{ old('main_text_en', optional($whyus)->main_text_en) }}</textarea>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="save-btn"><i class="fas fa-save"></i> حفظ القسم</button>
                        </div>
                    </form>
                </article>

                <article class="admin-card section-card hidden" id="section-card-whous">
                    <div class="card-header">
                        <h2><i class="fas fa-users"></i> قسم من نحن</h2>
                        <p>تعديل العنوان الرئيسي والعنوان الفرعي والفقرة الثانية.</p>
                    </div>
                    <form method="POST" action="{{ url('/whous') }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="whous_main_text_ar">العنوان الرئيسي بالعربية</label>
                            <textarea id="whous_main_text_ar" name="main_text_ar" rows="3">{{ old('main_text_ar', optional($whous)->main_text_ar) }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="whous_main_text_en">العنوان الرئيسي بالإنجليزية</label>
                            <textarea id="whous_main_text_en" name="main_text_en" rows="3">{{ old('main_text_en', optional($whous)->main_text_en) }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="whous_sub_text1_ar">العنوان الرئيسي الثاني بالعربية</label>
                            <textarea id="whous_sub_text1_ar" name="sub_text1_ar" rows="3">{{ old('sub_text1_ar', optional($whous)->sub_text1_ar) }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="whous_sub_text1_en">العنوان الرئيسي الثاني بالإنجليزية</label>
                            <textarea id="whous_sub_text1_en" name="sub_text1_en" rows="3">{{ old('sub_text1_en', optional($whous)->sub_text1_en) }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="whous_sub_text2_ar">الحقل الرئيسي الثاني بالعربية</label>
                            <textarea id="whous_sub_text2_ar" name="sub_text2_ar" rows="3">{{ old('sub_text2_ar', optional($whous)->sub_text2_ar) }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="whous_sub_text2_en">الحقل الرئيسي الثاني بالإنجليزية</label>
                            <textarea id="whous_sub_text2_en" name="sub_text2_en" rows="3">{{ old('sub_text2_en', optional($whous)->sub_text2_en) }}</textarea>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="save-btn"><i class="fas fa-save"></i> حفظ القسم</button>
                        </div>
                    </form>
                </article>
            </div>
        </div>
    </section>

    <footer class="footer">
        <div class="container">
            <p class="footer-desc">لوحة تحكم المدير - سندك برو &copy; 2026</p>
            <p>جميع الحقوق محفوظة | نسخة النظام 1.0.0</p>
            <p style="color: gray;">Powered by <a href="https://www.instagram.com/triple_core3" style="color: gray; text-decoration: none; color: #d4af37;">Triple Core</a></p>
        </div>
    </footer>

    <script src="{{ asset('script.js') }}?v={{ time() }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const sectionButtons = document.querySelectorAll('.section-edit-btn');
            const sectionCards = document.querySelectorAll('.section-card');
            const notice = document.getElementById('section-selected-notice');

            function showSectionCard(target) {
                sectionCards.forEach(card => {
                    if (card.id === `section-card-${target}`) {
                        card.classList.remove('hidden');
                        card.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    } else {
                        card.classList.add('hidden');
                    }
                });
                if (notice) {
                    notice.style.display = 'none';
                }
            }

            sectionButtons.forEach(button => {
                button.addEventListener('click', () => {
                    showSectionCard(button.dataset.target);
                });
            });
        });
    </script>
</body>
</html>