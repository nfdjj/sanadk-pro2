<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {!! isset($seoData) ? seo($seoData) : '' !!}   
     <link rel="stylesheet" href="{{ asset('styles.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&amp;display=swap" rel="stylesheet">
    
    <title>SANDEK PRO | سندك برو</title>
</head>
<body>
    <nav class="navbar">
        <div class="nav-container">
            <div class="logo">
                <img class="logo-ar" src="{{ asset('images/png/ايقونات سندك-٤٢.png') }}" alt="سندك">
                <img class="logo-en" src="{{ asset('images/png/ايقونات سندك-٣٩.png') }}" alt="Sandek">
            </div>
            <ul class="nav-menu">
                <li><a href="#home" data-en="Home" data-ar="الرئيسية">الرئيسية</a></li>
                <li><a href="#about" data-en="About" data-ar="من نحن">من نحن</a></li>
                <li><a href="#services" data-en="Services" data-ar="الخدمات">الخدمات</a></li>
                <li><a href="#features" data-en="Why Us" data-ar="لماذا نحن">لماذا نحن</a></li>
                <li><a href="#reviews" data-en="Review" data-ar="التقييمات">التقييمات</a></i>
                <li><a href="#contact" data-en="Contact" data-ar="تواصل">تواصل</a></li>
                <li class="nav-lang-item">
                    <div class="lang-toggle">
                        <button class="lang-btn" data-lang="en">EN</button>
                        <button class="lang-btn active" data-lang="ar">AR</button>
                    </div>
                </li>
            </ul>
            <div class="lang-toggle lang-toggle-desktop">
                <button class="lang-btn" data-lang="en">EN</button>
                <button class="lang-btn active" data-lang="ar">AR</button>
            </div>
            <div class="hamburger">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </nav>

    <!-- Hero -->
    <section id="home" class="hero">
        <div class="hero-content">
            <div class="hero-content-text">
                <h1 data-key="hero.title" data-en="{{ optional($hero)->title_en ?? 'Reliable solutions for labor services' }}" data-ar="{{ optional($hero)->title_ar ?? 'حلول موثوقة لخدمات العمالة' }}">{{ optional($hero)->title_ar ?? 'حلول موثوقة لخدمات العمالة' }}</h1>
                <p data-key="hero.content" data-en="{{ optional($hero)->content_en ?? 'We provide labor services through accredited offices with clear procedures and fast completion.' }}" data-ar="{{ optional($hero)->content_ar ?? 'نوفر خدمات العمالة عبر مكاتب معتمدة بإجراءات واضحة وإنجاز سريع.' }}">{{ optional($hero)->content_ar ?? 'نوفر خدمات العمالة عبر مكاتب معتمدة بإجراءات واضحة وإنجاز سريع.' }}</p>
            </div>
            <a href="https://api.whatsapp.com/send?phone={{ optional($hero)->whatsapp_number ?? '966500881876' }}" class="cta-btn" target="_blank" data-en="Contact Us" data-ar="تواصل معنا">تواصل معنا</a>
        </div>
    </section>

    <!-- About -->
    <section id="about" class="about">
        <div class="container">
            <h2 data-en="About Us" data-ar="من نحن">من نحن</h2>
            <!-- dynamic WhoUs content will render here; removed static duplicate to avoid two 'من نحن' entries -->
            <h3 class="about-subtitle" data-key="whous.main_text" data-en="{{ optional($whous)->main_text_en ?? 'Your trusted partner for coordinating labor services' }}" data-ar="{{ optional($whous)->main_text_ar ?? 'شريكك الموثوق لتنسيق خدمات العمالة' }}">{{ optional($whous)->main_text_ar ?? 'شريكك الموثوق لتنسيق خدمات العمالة' }}</h3>
            <p data-key="whous.sub_text1" data-en="{{ optional($whous)->sub_text1_en ?? 'We are a specialized entity providing coordination and follow-up services between clients and accredited agencies, aiming to streamline procedures and save time and effort for individuals and companies.' }}" data-ar="{{ optional($whous)->sub_text1_ar ?? 'نحن جهة متخصصة في تقديم خدمات التنسيق والمتابعة بين العملاء والمكاتب المعتمدة، بهدف تسهيل الإجراءات وتوفير الوقت والجهد على الأفراد والشركات.' }}">{{ optional($whous)->sub_text1_ar ?? 'نحن جهة متخصصة في تقديم خدمات التنسيق والمتابعة بين العملاء والمكاتب المعتمدة، بهدف تسهيل الإجراءات وتوفير الوقت والجهد على الأفراد والشركات.' }}</p>
            <p data-key="whous.sub_text2" data-en="{{ optional($whous)->sub_text2_en ?? 'We connect clients with accredited service providers and track requests step by step to ensure a smooth and professional experience, while adhering to transparency and accuracy at every stage of the process.' }}" data-ar="{{ optional($whous)->sub_text2_ar ?? 'نعمل على ربط العملاء بمقدمي الخدمات المعتمدين، ومتابعة الطلبات خطوة بخطوة لضمان تجربة سلسة واحترافية، مع الالتزام بالشفافية والدقة في جميع مراحل العمل.' }}">{{ optional($whous)->sub_text2_ar ?? 'نعمل على ربط العملاء بمقدمي الخدمات المعتمدين، ومتابعة الطلبات خطوة بخطوة لضمان تجربة سلسة واحترافية، مع الالتزام بالشفافية والدقة في جميع مراحل العمل.' }}</p>
        </div>
    </section>

    <!-- Services -->
    <section id="services" class="services">
        <div class="container">
            <h2 data-en="Our Services" data-ar="خدماتنا">خدماتنا</h2>
            <p class="section-subtitle" data-key="service.main_text" data-en="{{ optional($service)->main_text_en ?? 'Comprehensive Services to Facilitate Labor Procedures' }}" data-ar="{{ optional($service)->main_text_ar ?? 'خدمات متكاملة لتسهيل إجراءات العمالة' }}">{{ optional($service)->main_text_ar ?? 'خدمات متكاملة لتسهيل إجراءات العمالة' }}</p>
            <div class="services-grid">
                <div class="service-card">
                    <img data-key="service.service_image" src="{{ optional($service)->service_image ?? 'images/card3.jpg' }}" alt="service image" class="card-img">
                    <h3 data-key="service.title_text" data-en="{{ optional($service)->title_text_en ?? 'Service Title' }}" data-ar="{{ optional($service)->title_text_ar ?? 'عنوان الخدمة' }}">{{ optional($service)->title_text_ar ?? 'عنوان الخدمة' }}</h3>
                    <p data-key="service.description_text" data-en="{{ optional($service)->description_text_en ?? 'Service description' }}" data-ar="{{ optional($service)->description_text_ar ?? 'وصف الخدمة' }}">{{ optional($service)->description_text_ar ?? 'وصف الخدمة' }}</p>
                    <div class="service-card-btns">
                      <a href="https://api.whatsapp.com/send?phone={{ optional($service)->whatsapp_number ?? '966500881876' }}" class="whatsapp-btn" data-en="WhatsApp" data-ar="واتساب" target="_blank">واتساب</a>
                        <a href="tel:{{ optional($service)->phone_number ?? '+966500881876' }}" data-en="call" data-ar="اتصل بنا" class="call-btn">اتصل بنا</a>
                   </div>
                </div>
                <div class="service-card">
                    <img data-key="service.service_image2" src="{{ optional($service)->service_image2 ?? 'images/card3.jpg' }}" alt="service image" class="card-img">
                    <h3 data-key="service.title_text2" data-en="{{ optional($service)->title_text2_en ?? 'Service Title' }}" data-ar="{{ optional($service)->title_text2_ar ?? 'عنوان الخدمة' }}">{{ optional($service)->title_text2_ar ?? 'عنوان الخدمة' }}</h3>
                    <p data-key="service.description_text2" data-en="{{ optional($service)->description_text2_en ?? 'Service description' }}" data-ar="{{ optional($service)->description_text2_ar ?? 'وصف الخدمة' }}">{{ optional($service)->description_text2_ar ?? 'وصف الخدمة' }}</p>
                    <div class="service-card-btns">
                        <a href="https://api.whatsapp.com/send?phone={{ optional($service)->whatsapp_number ?? '966500881876' }}" class="whatsapp-btn" data-en="WhatsApp" data-ar="واتساب" target="_blank">واتساب</a>
                        <a href="tel:{{ optional($service)->phone_number ?? '+966500881876' }}" data-en="call" data-ar="اتصل بنا" class="call-btn">اتصل بنا</a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Features / Why Us -->
    <section id="features" class="features">
        <div class="container">
            <h2 data-en="Why Us?" data-ar="لماذا نحن">لماذا نحن</h2>
            <p class="section-subtitle" data-key="whyus.main_text" data-en="{{ optional($whyus)->main_text_en ?? 'Why Do Our Clients Trust Us?' }}" data-ar="{{ optional($whyus)->main_text_ar ?? 'لماذا يثق بنا عملاؤنا؟' }}">{{ optional($whyus)->main_text_ar ?? 'لماذا يثق بنا عملاؤنا؟' }}</p>
            <div class="features-grid">
                <div class="feature">
                    <span class="icon"><img src="{{ asset('images/png/ايقونات سندك-٣٢.png') }}" alt=""></span>
                    <h3 data-en="Speed in Completion" data-ar="سرعة في الإنجاز">سرعة في الإنجاز</h3>
                    <p data-en="We help you reach the relevant authorities and track your request as quickly as possible." data-ar="نساعدك في الوصول إلى الجهات المختصة ومتابعة طلبك بأسرع وقت ممكن.">نساعدك في الوصول إلى الجهات المختصة ومتابعة طلبك بأسرع وقت ممكن.</p>
                </div>
                <div class="feature">
                    <span class="icon"><img src="{{ asset('images/png/ايقونات سندك-٣٣.png') }}" alt=""></span>
                    <h3 data-en="Network of Accredited Offices" data-ar="شبكة مكاتب معتمدة">شبكة مكاتب معتمدة</h3>
                    <p data-en="We collaborate with a network of accredited offices and agencies to ensure the quality of services provided." data-ar="نتعاون مع مجموعة من المكاتب والجهات المعتمدة لضمان جودة الخدمات المقدمة.">نتعاون مع مجموعة من المكاتب والجهات المعتمدة لضمان جودة الخدمات المقدمة.</p>
                </div>
                <div class="feature">
                    <span class="icon"><img class="continuous-followup-icon" src="{{ asset('images/png/ايقونات سندك-٢٦.png') }}" alt=""></span>
                    <h3 data-en="Continuous Follow-up" data-ar="متابعة مستمرة">متابعة مستمرة</h3>
                    <p data-en="We monitor the status and provide ongoing updates." data-ar="نواكب حالة الطلب ونوفر تحديثات مستمرة حتى اكتمال الإجراءات.">نواكب حالة الطلب ونوفر تحديثات مستمرة حتى اكتمال الإجراءات.</p>
                </div>
                <div class="feature">
                    <span class="icon"><img class="professional-support-icon" src="{{ asset('images/png/ايقونات سندك-٢٣.png') }}" alt=""></span>
                    <h3 data-en="Professional Support" data-ar="خدمة احترافية">خدمة احترافية</h3>
                    <p data-en="A dedicated team is ready to answer your inquiries." data-ar="فريق متخصص جاهز للإجابة على الاستفسارات وتقديم الدعم اللازم.">فريق متخصص جاهز للإجابة على الاستفسارات وتقديم الدعم اللازم.</p>
                </div>
                <div class="feature">
                    <span class="icon"><img class="flexible-solutions-icon" src="{{ asset('images/png/ايقونات سندك-0٩.png') }}" alt=""></span>
                    <h3 data-en="Flexible Solutions" data-ar="حلول للأفراد والشركات">حلول للأفراد والشركات</h3>
                    <p data-en="We provide flexible services tailored to all needs." data-ar="نقدم خدمات مرنة تناسب احتياجات الجميع.">نقدم خدمات مرنة تناسب احتياجات الجميع.</p>
                </div>
                <div class="feature">
                    <span class="icon"><img src="{{ asset('images/png/ايقونات سندك-0٥.png') }}" alt=""></span>
                    <h3 data-en="Clear Procedures" data-ar="شفافية ووضوح">شفافية ووضوح</h3>
                    <p data-en="We make procedures clear and easy to follow." data-ar="نحرص على توضيح الإجراءات بشكل واضح وسلس.">نحرص على توضيح الإجراءات بشكل واضح وسلس.</p>
                </div>
            </div>
        </div>
    </section>

     <!-- Review Submission -->
    <section id="reviews" class="reviews">
        <div class="container">
            <h2 data-en="Customer Reviews" data-ar="آراء العملاء">آراء العملاء</h2>

            <div id="customer-reviews" class="customer-reviews-card" style="margin-bottom:28px;">
                <h3 style="margin-bottom:14px;" data-en="Latest Reviews" data-ar="آخر تقييمات العملاء">آخر تقييمات العملاء</h3>

                @php
                    $selectedReviewId = request()->query('review_id');
                @endphp

                @if(isset($opinions) && $opinions->count() > 0)
                    <div class="customer-reviews-grid" style="display:grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap:16px;">
                        @foreach($opinions as $opinion)
                            @php
                                $isSelected = (string)$selectedReviewId !== '' && (string)$opinion->id === (string)$selectedReviewId;
                                $rating = (int)($opinion->rating ?? 0);
                                $stars = str_repeat('★', $rating) . str_repeat('☆', 5 - $rating);
                            @endphp
                            <div class="customer-review-item" style="padding:16px; border:1px solid #e5e7eb; border-radius:12px; background:#fff; @if($isSelected) box-shadow:0 0 0 3px rgba(212,175,55,0.35); @endif">
                                <div style="font-size:14px; color:#6b7280; margin-bottom:8px;">
                                    <strong style="color:#111827;">{{ $opinion->name }}</strong>
                                    <span> · </span>
                                    <span>{{ $stars }} ({{ $rating }}/5)</span>
                                </div>
                                <p style="margin:0; line-height:1.7; color:#111827;">{{ $opinion->opinion }}</p>
                                <div style="margin-top:10px; font-size:12px; color:#6b7280;">
                                    {{ optional($opinion->created_at)->format('Y-m-d') }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p style="color:#6b7280;">لا توجد آراء لعرضها.</p>
                @endif
            </div>

            <div class="review-form-wrapper">
                <h3 data-en="Share Your Opinion" data-ar="شاركنا رأيك">شاركنا رأيك</h3>
                <form class="review-form" id="reviewForm">
                    <input type="text" id="reviewName" placeholder="اسمك / Your Name" required>
                    <div class="star-rating" id="starRating">
                        <span class="star" data-value="1">&#9733;</span>
                        <span class="star" data-value="2">&#9733;</span>
                        <span class="star" data-value="3">&#9733;</span>
                        <span class="star" data-value="4">&#9733;</span>
                        <span class="star" data-value="5">&#9733;</span>
                    </div>
                    <input type="hidden" id="ratingValue" value="0">
                    <div id="reviewMessage" class="review-message" aria-live="polite"></div>
                    <textarea id="reviewComment" placeholder="اكتب تجربتك... / Write your experience..." rows="4" required></textarea>
                    <button type="submit" class="submit-btn" data-en="Submit" data-ar="إرسال">إرسال</button>
                </form>
            </div>
        </div>
    </section>

    <!-- Contact -->
    <section id="contact" class="contact">
        <div class="container">
            <h2 data-en="Contact Us" data-ar="تواصل معنا">تواصل معنا</h2>
            <p class="contact-lead" data-en="We're happy to help! Do you have an inquiry or would like to request one of our services? Contact us and we'll get back to you as soon as possible." data-ar="يسعدنا خدمتك! لديك استفسار أو ترغب في طلب إحدى خدماتنا؟ تواصل معنا وسنقوم بالرد عليك في أقرب وقت.">يسعدنا خدمتك! لديك استفسار أو ترغب في طلب إحدى خدماتنا؟ تواصل معنا وسنقوم بالرد عليك في أقرب وقت.</p>
            <div class="contact-info">
                <p>
                <span data-en="Email:" data-ar="البريد الإلكتروني:">البريد الإلكتروني:</span><a href="mailto:sandekprob2b@gmail.com">sandekprob2b@gmail.com</a></p>
                <a href="https://api.whatsapp.com/send?phone={{ optional($service)->whatsapp_number ?? '966500881876' }}"><span data-en="Phone: +966 500 881 876" data-ar="الهاتف: 876 881 500 966+">الهاتف: {{ optional($service)->phone_number ?? '+966500881876' }}</span></a>
                <a href="tel:{{ optional($service)->phone_number ?? '+966500881876' }}" class="call-btn" data-en="Call Us" data-ar="اتصل بنا">اتصل بنا</a>
            </div>
        </div>
    </section>

    <footer class="footer">
        <div class="container">
            <p class="footer-desc" data-en="We provide coordination, follow-up, and client connection services with authorized offices and agencies, ensuring a professional experience that facilitates efficient and fast procedures." data-ar="نقدم خدمات التنسيق والمتابعة وربط العملاء بالمكاتب والجهات المعتمدة، مع الحرص على تقديم تجربة احترافية تسهّل إنجاز الإجراءات بكفاءة وسرعة.">نقدم خدمات التنسيق والمتابعة وربط العملاء بالمكاتب والجهات المعتمدة، مع الحرص على تقديم تجربة احترافية تسهّل إنجاز الإجراءات بكفاءة وسرعة.</p>
            <p data-en="&copy; 2026 SANDEK PRO. All rights reserved." data-ar="&copy; 2026 سندك برو. جميع الحقوق محفوظة.">&copy; 2026 سندك برو. جميع الحقوق محفوظة.</p>
            <p style="color: gray;">Powered by <a href="https://www.instagram.com/triple_core3" style="color: gray; text-decoration: none; color: #d4af37;">Triple Core</a></p>
        </div>
    </footer>

    <a href="https://api.whatsapp.com/send?phone={{ optional($service)->whatsapp_number ?? '966500881876' }}" class="floating-whatsapp" target="_blank">
        <img src="{{ asset('images/png/ايقونات سندك-0١.png') }}" alt="WhatsApp">
    </a>

    <script src="{{ asset('script.js') }}"></script>
</body>
</html>
