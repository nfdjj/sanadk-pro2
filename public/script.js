// Language Toggle
const langBtns = document.querySelectorAll('.lang-btn');
const body = document.body;

langBtns.forEach(btn => {
    btn.addEventListener('click', () => {
        const lang = btn.dataset.lang;

        // Update active state on ALL lang buttons (desktop + mobile)
        langBtns.forEach(b => {
            b.classList.toggle('active', b.dataset.lang === lang);
        });

        // Update body classes
        body.classList.remove('ltr', 'rtl');
        body.classList.add(lang === 'ar' ? 'rtl' : 'ltr');

        // Update all text content
        document.querySelectorAll('[data-en][data-ar]').forEach(el => {
            // Skip elements that have children with data attributes (like the logo)
            // but still allow updating the parent element text.
            const hasChildData = !!el.querySelector('[data-en][data-ar]');
            if (hasChildData) return;

            const text = el.dataset[lang];
            if (typeof text !== 'string') return;
            el.textContent = text;
        });

        // Smooth scroll to top
        window.scrollTo({ top: 0, behavior: 'smooth' });

        // Close mobile menu on language switch
        hamburger.classList.remove('active');
        navMenu.classList.remove('active');
    });
});

// Mobile Menu Toggle
const hamburger = document.querySelector('.hamburger');
const navMenu = document.querySelector('.nav-menu');

if (hamburger && navMenu) {
    hamburger.addEventListener('click', () => {
        hamburger.classList.toggle('active');
        navMenu.classList.toggle('active');
    });
}

// Close mobile menu when clicking on a link
document.querySelectorAll('.nav-menu a').forEach(link => {
    link.addEventListener('click', () => {
        if (hamburger) hamburger.classList.remove('active');
        if (navMenu) navMenu.classList.remove('active');
    });
});

// Smooth Scrolling
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});

// Navbar glass effect on scroll
const navbar = document.querySelector('.navbar');
const updateNavbarOnScroll = () => {
    if (navbar) {
        navbar.classList.toggle('scrolled', window.scrollY > 50);
    }
};

window.addEventListener('scroll', updateNavbarOnScroll, { passive: true });
updateNavbarOnScroll();

// Animate elements on scroll
const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.style.opacity = '1';
            entry.target.style.transform = 'translateY(0)';
        }
    });
}, observerOptions);

// Observe service cards and features
document.querySelectorAll('.service-card, .feature').forEach(el => {
    el.style.opacity = '0';
    el.style.transform = 'translateY(20px)';
    el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
    observer.observe(el);
});

// Set initial language (Arabic)
const defaultLangBtn = document.querySelector('[data-lang="ar"]');
if (defaultLangBtn) {
    defaultLangBtn.click();
}

// ── Reviews ──────────────────────────────────────────────
const reviewForm   = document.getElementById('reviewForm');
const reviewsList  = document.getElementById('reviewsList');
// if not present (current index.blade.php renders reviews server-side), keep script safe
const reviewsGrid  = document.querySelector('.reviews-grid');
const reviewsContainer = reviewsList || reviewsGrid;
const stars        = document.querySelectorAll('.star');
const ratingInput  = document.getElementById('ratingValue');
const csrfToken    = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

let reviews = [];

if (reviewForm) {
    // Only load reviews when the list container exists.
    document.addEventListener('DOMContentLoaded', () => {
        if (reviewsContainer) {
            loadReviews();
        }
    });

    // Star hover & click handling for the review form.
    stars.forEach(star => {
        star.addEventListener('mouseover', () => {
            const val = +star.dataset.value;
            stars.forEach(s => s.classList.toggle('hovered', +s.dataset.value <= val));
        });
        star.addEventListener('mouseout', () => {
            stars.forEach(s => s.classList.remove('hovered'));
        });
        star.addEventListener('click', () => {
            const val = +star.dataset.value;
            if (ratingInput) ratingInput.value = val;
            stars.forEach(s => s.classList.toggle('selected', +s.dataset.value <= val));
        });
    });

    reviewForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        const name    = document.getElementById('reviewName').value.trim();
        const comment = document.getElementById('reviewComment').value.trim();
        const rating  = ratingInput ? +ratingInput.value : null;

        if (!name) {
            showReviewMessage('يرجى إدخال الاسم', 'error');
            return;
        }

        if (!comment) {
            showReviewMessage('يرجى إدخال الرد أو الرأي', 'error');
            return;
        }

        if (!rating || rating < 1) {
            showReviewMessage('يرجى إدخال التقييم', 'error');
            return;
        }

        try {
            const payload = { name, opinion: comment, rating };

            const response = await fetch('/opinions', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken || ''
                },
                body: JSON.stringify(payload)
            });

            if (!response.ok) {
                const ct = response.headers.get('content-type') || '';
                let body = null;
                if (ct.includes('application/json')) {
                    body = await response.json();
                } else {
                    body = await response.text();
                }
                console.error('Failed to post opinion', response.status, body);
                showReviewMessage('حدث خطأ أثناء حفظ الرد، حاول مرة أخرى. (رمز: ' + response.status + ')', 'error');
                return;
            }

            reviewForm.reset();
            if (ratingInput) ratingInput.value = 0;
            stars.forEach(s => s.classList.remove('selected'));
            if (reviewsContainer) {
                loadReviews();
            }
            showReviewMessage('تم ارسال الرد', 'success');
        } catch (error) {
            console.error(error);
            showReviewMessage('حدث خطأ أثناء حفظ الرد، حاول مرة أخرى', 'error');
        }
    });
}

// Show inline message for the review form
function showReviewMessage(message, type = 'success') {
    const container = document.getElementById('reviewMessage');
    if (!container) {
        alert(message);
        return;
    }
    container.textContent = message;
    container.className = 'review-message ' + (type === 'error' ? 'error' : 'success');
    // auto-hide after 5 seconds
    clearTimeout(container._hideTimer);
    container._hideTimer = setTimeout(() => {
        container.textContent = '';
        container.className = 'review-message';
    }, 5000);
}

async function loadReviews() {
    try {
        const response = await fetch('/opinions');
        const data = await response.json();
        reviews = Array.isArray(data) ? data : [];
        renderReviews();
    } catch (error) {
        console.error('Failed to load reviews:', error);
    }
}

function renderReviews() {
    const target = reviewsList || reviewsGrid;
    if (!target) return;

    if (!reviews || reviews.length === 0) {
        target.innerHTML = '<p class="no-reviews">لا توجد تقييمات بعد. كن أول من يشارك رأيه!</p>';
        return;
    }

    target.innerHTML = reviews.map(r => { 
        const date = r.created_at ? new Date(r.created_at).toLocaleDateString('en-GB') : '';
        return `
            <div class="review-card">
                <div class="review-card-header">
                    <span class="review-card-name">${escapeHtml(r.name)}</span>
                    <span class="review-card-date">${escapeHtml(date)}</span>
                </div>
                <p class="review-card-comment">${escapeHtml(r.opinion)}</p>
            </div>
        `;
    }).join('');
}

function escapeHtml(str) {
    return String(str || '').replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');
}

// ── Live update sections (simple polling) ─────────────────────────────────
async function fetchSection(endpoint) {
    try {
        const res = await fetch(endpoint, { headers: { 'Accept': 'application/json' } });
        if (!res.ok) return null;
        const data = await res.json();
        return data && Object.keys(data).length ? data : null;
    } catch (e) {
        return null;
    }
}

function applyLocalizedTextToElements(keyPrefix, data) {
    if (!data) return;
    // mappings of fields -> data-key values used in blade
    const map = {
        'hero': { title: ['title_en','title_ar'], content: ['content_en','content_ar'] },
        'service': { 
            title_text: ['title_text_en','title_text_ar'], description_text: ['description_text_en','description_text_ar'], service_image: ['service_image'],
            title_text2: ['title_text2_en','title_text2_ar'], description_text2: ['description_text2_en','description_text2_ar'], service_image2: ['service_image2'],
            title_text3: ['title_text3_en','title_text3_ar'], description_text3: ['description_text3_en','description_text3_ar'], service_image3: ['service_image3'],
            title_text4: ['title_text4_en','title_text4_ar'], description_text4: ['description_text4_en','description_text4_ar'], service_image4: ['service_image4']
        },
        'whous': { main_text: ['main_text_en','main_text_ar'], sub_text1: ['sub_text1_en','sub_text1_ar'], sub_text2: ['sub_text2_en','sub_text2_ar'] },
        'whyus': { main_text: ['main_text_en','main_text_ar'], sub_text1: ['sub_text1_en','sub_text1_ar'], sub_text2: ['sub_text2_en','sub_text2_ar'] }
    };

    const mapping = map[keyPrefix];
    if (!mapping) return;

    for (const fieldKey in mapping) {
        const keys = mapping[fieldKey];
        const selector = `[data-key="${keyPrefix}.${fieldKey}"]`;
        document.querySelectorAll(selector).forEach(el => {
            if (keys.length >= 2) {
                el.dataset.en = data[keys[0]] || el.dataset.en || '';
                el.dataset.ar = data[keys[1]] || el.dataset.ar || '';
            } else {
                // e.g., image src
                const val = data[keys[0]] || el.getAttribute('src') || '';
                el.setAttribute('src', val);
            }
        });
    }
}

function refreshTextByLang() {
    const active = document.querySelector('.lang-btn.active');
    const lang = active ? active.dataset.lang : (document.body.classList.contains('rtl') ? 'ar' : 'en');
    document.querySelectorAll('[data-en][data-ar]').forEach(el => {
        if (el.querySelector('[data-en]')) return;
        const text = el.dataset[lang] || '';
        el.textContent = text;
    });
}

function loadLocalAdminContent() {
    try {
        const stored = localStorage.getItem('adminSiteContent');
        if (!stored) return;
        const content = JSON.parse(stored);
        if (content && typeof content === 'object') {
            if (content.hero) applyLocalizedTextToElements('hero', content.hero);
            if (content.service) applyLocalizedTextToElements('service', content.service);
            if (content.whous) applyLocalizedTextToElements('whous', content.whous);
            if (content.whyus) applyLocalizedTextToElements('whyus', content.whyus);
            refreshTextByLang();
        }
    } catch (e) {
        console.warn('Unable to load local admin content:', e);
    }
}

async function pollSectionsOnce() {
    const [hero, service, whous, whyus] = await Promise.all([
        fetchSection('/hero'),
        fetchSection('/service'),
        fetchSection('/whous'),
        fetchSection('/whyus')
    ]);

    if (hero) applyLocalizedTextToElements('hero', hero);
    if (service) applyLocalizedTextToElements('service', service);
    if (whous) applyLocalizedTextToElements('whous', whous);
    if (whyus) applyLocalizedTextToElements('whyus', whyus);

    refreshTextByLang();
}

// Start polling only on the public index page to reflect admin changes
const pathname = window.location.pathname || '/';
const isIndexPage = pathname === '/' || pathname.endsWith('/index.php') || pathname === '';
if (isIndexPage) {
    // Load any local admin fallback content before starting polling
    loadLocalAdminContent();
    // Start polling every 5 seconds
    setInterval(pollSectionsOnce, 5000);
    // run once on load
    document.addEventListener('DOMContentLoaded', pollSectionsOnce);
} else {
    // avoid polling on admin pages to prevent excessive requests
    console.log('pollSectionsOnce: not running on this page (', pathname, ')');
}

// ── Admin reviews delete: custom confirm modal to avoid showing raw JSON ──
document.addEventListener('DOMContentLoaded', () => {
    const deleteForms = document.querySelectorAll('.review-delete-form');
    const confirmModal = document.getElementById('confirmModal');
    const confirmMsgEl = document.getElementById('confirmModalMessage');
    const confirmOk = document.getElementById('confirmOk');
    const confirmCancel = document.getElementById('confirmCancel');
    const confirmCancelBtn = document.getElementById('confirmCancelBtn');
    const adminBanner = document.getElementById('adminDeleteMessage');
    let currentForm = null;

    if (!deleteForms || deleteForms.length === 0) return;

    function showBanner(text, isError = false) {
        if (!adminBanner) {
            alert(text);
            return;
        }
        adminBanner.textContent = text;
        adminBanner.className = isError ? 'alert alert-error' : 'alert alert-success';
        adminBanner.style.display = 'block';
        setTimeout(() => { adminBanner.style.display = 'none'; }, 4000);
    }

    deleteForms.forEach(f => {
        f.addEventListener('submit', (e) => {
            e.preventDefault();
            currentForm = f;
            if (confirmMsgEl) confirmMsgEl.textContent = 'هل أنت متأكد من حذف هذا الرد؟';
            if (confirmModal) confirmModal.style.display = 'flex';
        });
    });

    function closeModal() {
        if (confirmModal) confirmModal.style.display = 'none';
        currentForm = null;
    }

    if (confirmCancel) confirmCancel.addEventListener('click', closeModal);
    if (confirmCancelBtn) confirmCancelBtn.addEventListener('click', closeModal);

    if (confirmOk) confirmOk.addEventListener('click', async () => {
        if (!currentForm) return closeModal();
        const action = currentForm.action;
        const id = currentForm.dataset.id;
        try {
            const res = await fetch(action, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': csrfToken || '',
                    'Accept': 'application/json'
                }
            });
            if (res.ok) {
                // remove row from table
                const row = document.getElementById('review-row-' + id);
                if (row) row.remove();
                showBanner('تم حذف الرد بنجاح');
            } else {
                showBanner('حدث خطأ أثناء الحذف', true);
            }
        } catch (err) {
            console.error(err);
            showBanner('حدث خطأ أثناء الحذف', true);
        }
        closeModal();
    });
});

// General admin helpers: auto-hide server flash alerts and handle admin 'تفريغ' forms
function showAdminBanner(text, isError = false) {
    const adminBanner = document.getElementById('adminDeleteMessage');
    if (!adminBanner) {
        // fallback
        const el = document.querySelector('.alert') || document.body;
        if (el) alert(text);
        return;
    }
    adminBanner.textContent = text;
    adminBanner.className = isError ? 'alert alert-error' : 'alert alert-success';
    adminBanner.style.display = 'block';
    setTimeout(() => { adminBanner.style.display = 'none'; }, 3500);
}

document.addEventListener('DOMContentLoaded', () => {
    // auto-hide any server-rendered flash alerts
    document.querySelectorAll('.alert').forEach(a => {
        setTimeout(() => {
            try { a.style.display = 'none'; } catch (e) {}
        }, 3500);
    });

    // intercept admin 'تفريغ' forms with ids like delete-*-form
    const adminDeleteForms = document.querySelectorAll('form[id^="delete-"]');
    adminDeleteForms.forEach(f => {
        f.addEventListener('submit', async (e) => {
            e.preventDefault();
            const ok = confirm('هل أنت متأكد من تفريغ محتوى هذا القسم؟');
            if (!ok) return;
            const action = f.action;
            try {
                const res = await fetch(action, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken || '',
                        'Accept': 'application/json'
                    }
                });
                if (res.ok) {
                    showAdminBanner('تم تفريغ المحتوى بنجاح');
                    setTimeout(() => { location.reload(); }, 900);
                } else {
                    showAdminBanner('حدث خطأ أثناء التفريغ', true);
                }
            } catch (err) {
                console.error(err);
                showAdminBanner('حدث خطأ أثناء التفريغ', true);
            }
        });
    });
});

