// بيانات الأقسام الأساسية (الأربعة الرئيسية)
let siteContent = {
    "hero": {
        id: "hero",
        title_ar: "الرئيسية",
        title_en: "Home",
        content_ar: "حلول موثوقة لخدمات العمالة - نوفر خدمات العمالة عبر مكاتب معتمدة بإجراءات واضحة وإنجاز سريع.",
        content_en: "Reliable solutions for labor services - We provide labor services through accredited offices with clear procedures and fast completion.",
        lastModified: "2026-06-05"
    },
    "service": {
        id: "service",
        main_text_ar: "نص خدماتنا الرئيسي",
        main_text_en: "Main services text",
        service_image: "images/card3.jpg",
        title_text_ar: "عنوان الخدمة",
        title_text_en: "Service Title",
        description_text_ar: "وصف الخدمة",
        description_text_en: "Service description",
        button_text1_ar: "زر 1",
        button_text1_en: "Button 1",
        button_text2_ar: "زر 2",
        button_text2_en: "Button 2",
        lastModified: "2026-06-05"
    },
    "whyus": {
        id: "whyus",
        main_text_ar: "لماذا نحن",
        main_text_en: "Why Us?",
        sub_text1_ar: "نص فرعي 1",
        sub_text1_en: "Sub text 1",
        sub_text2_ar: "نص فرعي 2",
        sub_text2_en: "Sub text 2",
        lastModified: "2026-06-05"
    },
    "whous": {
        id: "whous",
        main_text_ar: "من نحن",
        main_text_en: "Who We Are",
        sub_text1_ar: "نص فرعي 1",
        sub_text1_en: "Sub text 1",
        sub_text2_ar: "نص فرعي 2",
        sub_text2_en: "Sub text 2",
        lastModified: "2026-06-05"
    }
};

const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
const sectionConfigs = {
    hero: {
        endpoint: '/hero',
        displayField: 'content_ar',
        fields: [
            { name: 'title_ar', label: 'العنوان بالعربية', type: 'text' },
            { name: 'title_en', label: 'العنوان بالإنجليزية', type: 'text' },
            { name: 'content_ar', label: 'المحتوى بالعربية', type: 'textarea' },
            { name: 'content_en', label: 'المحتوى بالإنجليزية', type: 'textarea' }
        ]
    },
    service: {
        endpoint: '/service',
        displayField: 'main_text_ar',
        fields: [
            { name: 'main_text_ar', label: 'النص الرئيسي بالعربية', type: 'textarea' },
            { name: 'main_text_en', label: 'النص الرئيسي بالإنجليزية', type: 'textarea' },
            { name: 'service_image', label: 'رابط صورة الخدمة', type: 'text' },
            { name: 'title_text_ar', label: 'عنوان الخدمة بالعربية', type: 'text' },
            { name: 'title_text_en', label: 'عنوان الخدمة بالإنجليزية', type: 'text' },
            { name: 'description_text_ar', label: 'وصف الخدمة بالعربية', type: 'textarea' },
            { name: 'description_text_en', label: 'وصف الخدمة بالإنجليزية', type: 'textarea' },
            { name: 'button_text1_ar', label: 'نص الزر الأول بالعربية', type: 'text' },
            { name: 'button_text1_en', label: 'نص الزر الأول بالإنجليزية', type: 'text' },
            { name: 'button_text2_ar', label: 'نص الزر الثاني بالعربية', type: 'text' },
            { name: 'button_text2_en', label: 'نص الزر الثاني بالإنجليزية', type: 'text' }
        ]
    },
    whyus: {
        endpoint: '/whyus',
        displayField: 'main_text_ar',
        fields: [
            { name: 'main_text_ar', label: 'النص الرئيسي بالعربية', type: 'textarea' },
            { name: 'main_text_en', label: 'النص الرئيسي بالإنجليزية', type: 'textarea' },
            { name: 'sub_text1_ar', label: 'النص الفرعي 1 بالعربية', type: 'textarea' },
            { name: 'sub_text1_en', label: 'النص الفرعي 1 بالإنجليزية', type: 'textarea' },
            { name: 'sub_text2_ar', label: 'النص الفرعي 2 بالعربية', type: 'textarea' },
            { name: 'sub_text2_en', label: 'النص الفرعي 2 بالإنجليزية', type: 'textarea' }
        ]
    },
    whous: {
        endpoint: '/whous',
        displayField: 'main_text_ar',
        fields: [
            { name: 'main_text_ar', label: 'النص الرئيسي بالعربية', type: 'textarea' },
            { name: 'main_text_en', label: 'النص الرئيسي بالإنجليزية', type: 'textarea' },
            { name: 'sub_text1_ar', label: 'النص الفرعي 1 بالعربية', type: 'textarea' },
            { name: 'sub_text1_en', label: 'النص الفرعي 1 بالإنجليزية', type: 'textarea' },
            { name: 'sub_text2_ar', label: 'النص الفرعي 2 بالعربية', type: 'textarea' },
            { name: 'sub_text2_en', label: 'النص الفرعي 2 بالإنجليزية', type: 'textarea' }
        ]
    }
};

// تهيئة الصفحة عند التحميل
document.addEventListener('DOMContentLoaded', function() {
    window._adminInitialized = true;
    try {
        console.log('admin.js loaded, siteContent keys:', Object.keys(siteContent));
        const statusEl = document.getElementById('admin-js-status');
        if (statusEl) statusEl.style.display = 'none';
        // تحديث الإحصائيات
        updateStats();

        // تحميل جدول المحتوى من البيانات المحلية مباشرة
        loadContentTable();

        // محاولة تحميل البيانات من الخادم (اختياري)
        // إذا فشل أو كانت البيانات فارغة، نستخدم البيانات المحلية
        loadAllSectionsFromServer().catch(() => {
            console.log('Using local data');
        });

        // إعداد أحداث النافذة المنبثقة
        setupModalEvents();
    } catch (err) {
        console.error('Initialization error in admin.js', err);
        try { showDevError('Initialization error: ' + (err && err.message ? err.message : String(err))); } catch (e) {}
    }
});

// --- أدوات مساعدة لعرض أخطاء التطوير داخل واجهة الإدارة ---
function ensureErrorOverlay() {
    if (document.getElementById('dev-error-overlay')) return;
    const overlay = document.createElement('div');
    overlay.id = 'dev-error-overlay';
    overlay.style.position = 'fixed';
    overlay.style.right = '10px';
    overlay.style.bottom = '10px';
    overlay.style.zIndex = 99999;
    overlay.style.maxWidth = '420px';
    overlay.style.background = 'rgba(0,0,0,0.8)';
    overlay.style.color = '#fff';
    overlay.style.padding = '12px';
    overlay.style.borderRadius = '6px';
    overlay.style.fontSize = '13px';
    overlay.style.boxShadow = '0 6px 18px rgba(0,0,0,0.4)';
    overlay.style.display = 'none';
    document.body.appendChild(overlay);
}

function showDevError(msg) {
    ensureErrorOverlay();
    const overlay = document.getElementById('dev-error-overlay');
    overlay.textContent = msg;
    overlay.style.display = 'block';
}

window.addEventListener('error', function (e) {
    try { showDevError('Error: ' + (e && e.message ? e.message : String(e))); } catch (e2) {}
});

window.addEventListener('unhandledrejection', function (e) {
    try { showDevError('UnhandledRejection: ' + (e && e.reason ? (e.reason.message || JSON.stringify(e.reason)) : String(e))); } catch (e2) {}
});

// تحديث الإحصائيات
async function updateStats() {
    try {
        const response = await fetch('/opinions');
        const reviews = await response.json();
        document.getElementById('total-reviews').textContent = Array.isArray(reviews) ? reviews.length : 0;
    } catch (error) {
        console.error('Failed to load review count:', error);
        document.getElementById('total-reviews').textContent = '0';
    }
}
// تحميل جدول المحتوى
function loadContentTable() {
    const tableBody = document.getElementById('content-table');
    console.log('loadContentTable called, tableBody:', tableBody, 'siteContent:', siteContent);
    if (!tableBody) return;
    
    tableBody.innerHTML = '';
    let index = 1;
    
    // تعريف أسماء الأقسام بالعربية
    const sectionTitles = {
        'hero': 'الرئيسية',
        'service': 'الخدمات',
        'whyus': 'لماذا نحن',
        'whous': 'من نحن'
    };
    
    for (const key in siteContent) {
        const section = siteContent[key];
        const config = sectionConfigs[section.id];
        
        if (!config) continue;
        
        const displayField = config?.displayField || 'content_ar';
        const displayValue = section[displayField] || section.title_ar || section.main_text_ar || '';
        
        const shortContent = displayValue && displayValue.length > 80
            ? displayValue.substring(0, 80) + '...'
            : (displayValue || '');
        
        // استخدام الاسم العربي المحدد للقسم
        const sectionTitle = sectionTitles[section.id] || section.title_ar || section.main_text_ar || key;
        
        const row = document.createElement('tr');

        row.innerHTML = `
            <td>${index}</td>
            <td>${escapeHtml(sectionTitle)}</td>
            <td title="${escapeHtml(displayValue)}">${escapeHtml(shortContent)}</td>
            <td>${escapeHtml(section.lastModified || '')}</td>
            <td class="actions-cell">
                <button class="action-btn edit-btn" data-id="${section.id}">
                    <i class="fas fa-edit"></i> تعديل
                </button>
                <button class="action-btn delete-btn" data-id="${section.id}">
                    <i class="fas fa-trash"></i> حذف
                </button>
            </td>
        `;
        tableBody.appendChild(row);
        index++;
    }
    
    // إضافة أحداث الأزرار
    document.querySelectorAll('.edit-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const sectionId = this.dataset.id;
            openEditModal(sectionId);
        });
    });
    
    document.querySelectorAll('.delete-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const sectionId = this.dataset.id;
            if (confirm('هل أنت متأكد من حذف هذا القسم؟')) {
                deleteSection(sectionId);
            }
        });
    });
}


// فتح نافذة التعديل
function openEditModal(sectionId) {
    const section = siteContent[sectionId];
    const config = sectionConfigs[sectionId];
    if (!section || !config) return;

    document.getElementById('edit-section-id').value = section.id;
    const fieldsContainer = document.getElementById('edit-fields');
    fieldsContainer.innerHTML = '';
    buildEditFields(sectionId, section, config.fields);

    document.getElementById('edit-modal').style.display = 'flex';
}

// إعداد أحداث النافذة المنبثقة
function setupModalEvents() {
    const modal = document.getElementById('edit-modal');
    const closeBtn = document.querySelector('.close-btn');
    const cancelBtn = document.querySelector('.cancel-btn');
    const editForm = document.getElementById('edit-form');
    
    // إغلاق النافذة
    closeBtn.addEventListener('click', () => {
        modal.style.display = 'none';
    });
    
    cancelBtn.addEventListener('click', () => {
        modal.style.display = 'none';
    });
    
    // إغلاق عند النقر خارج النافذة
    modal.addEventListener('click', (e) => {
        if (e.target === modal) {
            modal.style.display = 'none';
        }
    });
    
    // معالجة حفظ التعديلات
    editForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const sectionId = document.getElementById('edit-section-id').value;
        const config = sectionConfigs[sectionId];
        if (!config) {
            alert('القسم غير معروف');
            return;
        }

        const payload = {};
        let missing = false;
        config.fields.forEach(field => {
            const input = document.getElementById(`edit-${field.name}`);
            if (!input) return;
            const value = input.value.trim();
            if (!value) {
                missing = true;
            }
            payload[field.name] = value;
        });

        if (missing) {
            alert('يرجى ملء جميع الحقول');
            return;
        }

        saveSectionToServer(sectionId, payload)
            .then(saved => {
                siteContent[sectionId] = {
                    ...siteContent[sectionId],
                    ...saved,
                    lastModified: new Date().toISOString().split('T')[0]
                };
                loadContentTable();
                modal.style.display = 'none';
                showAlert('تم حفظ التعديلات في قاعدة البيانات بنجاح', 'success');
            })
            .catch(error => {
                console.error(error);
                alert('حدث خطأ أثناء حفظ البيانات. حاول مرة أخرى.');
            });
    });
}

// ملاحظة: لا نقوم بتحميل أو عرض الآراء المخزنة في صفحة الإدارة.
// عمليات إدارة الآراء تتم في صفحة المراجعات المخصصة (reviews.blade.php).

// حذف قسم
function deleteSection(sectionId) {
    if (confirm('هل أنت متأكد من حذف هذا القسم؟ سيتم حذفه نهائياً من قاعدة البيانات.')) {
        const config = sectionConfigs[sectionId];
        if (config && config.endpoint) {
            fetch(config.endpoint, {
                method: 'DELETE',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken || ''
                }
            })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(err => { throw new Error(err.message || 'HTTP ' + response.status); });
                }
                return response.json();
            })
            .then(() => {
                // بعد الحذف من قاعدة البيانات، نعيد تعيين البيانات الافتراضية
                resetSectionToDefaults(sectionId);
                loadContentTable();
                showAlert('تم حذف القسم من قاعدة البيانات وإعادة تعيينه إلى القيم الافتراضية', 'success');
            })
            .catch(err => {
                console.error(err);
                alert('فشل حذف القسم من الخادم. تأكد من إعداد المسار وجرّب مرة أخرى.');
            });
        } else {
            // إذا لم يكن هناك endpoint، نعيد تعيين البيانات الافتراضية محليًا
            resetSectionToDefaults(sectionId);
            loadContentTable();
            showAlert('تم إعادة تعيين القسم إلى القيم الافتراضية', 'success');
        }
    }
}

// إعادة تعيين القسم إلى القيم الافتراضية
function resetSectionToDefaults(sectionId) {
    // البيانات الافتراضية الأصلية
    const defaultData = {
        "hero": {
            id: "hero",
            title_ar: "الرئيسية",
            title_en: "Home",
            content_ar: "حلول موثوقة لخدمات العمالة - نوفر خدمات العمالة عبر مكاتب معتمدة بإجراءات واضحة وإنجاز سريع.",
            content_en: "Reliable solutions for labor services - We provide labor services through accredited offices with clear procedures and fast completion.",
            lastModified: new Date().toISOString().split('T')[0]
        },
        "service": {
            id: "service",
            main_text_ar: "نص خدماتنا الرئيسي",
            main_text_en: "Main services text",
            service_image: "images/card3.jpg",
            title_text_ar: "عنوان الخدمة",
            title_text_en: "Service Title",
            description_text_ar: "وصف الخدمة",
            description_text_en: "Service description",
            button_text1_ar: "زر 1",
            button_text1_en: "Button 1",
            button_text2_ar: "زر 2",
            button_text2_en: "Button 2",
            lastModified: new Date().toISOString().split('T')[0]
        },
        "whyus": {
            id: "whyus",
            main_text_ar: "لماذا نحن",
            main_text_en: "Why Us?",
            sub_text1_ar: "نص فرعي 1",
            sub_text1_en: "Sub text 1",
            sub_text2_ar: "نص فرعي 2",
            sub_text2_en: "Sub text 2",
            lastModified: new Date().toISOString().split('T')[0]
        },
        "whous": {
            id: "whous",
            main_text_ar: "من نحن",
            main_text_en: "Who We Are",
            sub_text1_ar: "نص فرعي 1",
            sub_text1_en: "Sub text 1",
            sub_text2_ar: "نص فرعي 2",
            sub_text2_en: "Sub text 2",
            lastModified: new Date().toISOString().split('T')[0]
        }
    };
    
    if (defaultData[sectionId]) {
        siteContent[sectionId] = defaultData[sectionId];
    }
}

// عرض رسالة تنبيه
function loadSectionFromServer(sectionId) {
    const config = sectionConfigs[sectionId];
    if (!config) return Promise.resolve();

    return fetch(config.endpoint, {
        headers: {
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        // إذا كانت البيانات موجودة وغير فارغة، نستخدمها
        if (data && Object.keys(data).length > 0) {
            // Preserve the section ID (like "hero", "service") not the database ID
            const { id: dbId, ...dataWithoutId } = data;
            siteContent[sectionId] = {
                ...siteContent[sectionId],
                ...dataWithoutId,
                id: sectionId, // Always use the section ID, not database ID
                lastModified: new Date().toISOString().split('T')[0]
            };
        }
        // إذا كانت البيانات فارغة، نستخدم البيانات المحلية الموجودة
        loadContentTable();
    })
    .catch(error => {
        console.warn(`Unable to load ${sectionId} content from server:`, error);
        // في حالة الخطأ، نستخدم البيانات المحلية
        loadContentTable();
    });
}

function loadAllSectionsFromServer() {
    return Promise.all(Object.keys(sectionConfigs).map(loadSectionFromServer));
}

function saveSectionToServer(sectionId, data) {
    const config = sectionConfigs[sectionId];
    if (!config) {
        return Promise.reject(new Error('Unknown section'));
    }
    return fetch(config.endpoint, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': csrfToken || ''
        },
        body: JSON.stringify(data)
    })
    .then(response => {
        if (!response.ok) {
            return response.json().then(err => {
                throw new Error(err.message || 'HTTP ' + response.status);
            });
        }
        return response.json();
    });
}
function buildEditFields(sectionId, section, fields) {
    const container = document.getElementById('edit-fields');
    container.innerHTML = '';
    fields.forEach(field => {
        const wrapper = document.createElement('div');
        wrapper.className = 'form-group';
        const label = document.createElement('label');
        label.setAttribute('for', `edit-${field.name}`);
        label.textContent = field.label;
        let input;
        if (field.type === 'textarea') {
            input = document.createElement('textarea');
            input.rows = 4;
        } else {
            input = document.createElement('input');
            input.type = field.type;
        }
        input.id = `edit-${field.name}`;
        input.value = section[field.name] || '';
        input.required = true;
        wrapper.appendChild(label);
        wrapper.appendChild(input);
        container.appendChild(wrapper);
    });
}

function showAlert(message, type = 'success') {
    // إزالة أي رسالة سابقة
    const existingAlert = document.querySelector('.alert');
    if (existingAlert) {
        existingAlert.remove();
    }
    
    // إنشاء رسالة جديدة
    const alert = document.createElement('div');
    alert.className = `alert alert-${type}`;
    alert.innerHTML = `
        <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'}"></i>
        <span>${message}</span>
    `;
    
    // إضافة الرسالة في أعلى الصفحة
    const dashboard = document.querySelector('.admin-dashboard .container');
    dashboard.insertBefore(alert, dashboard.firstChild);
    
    // إزالة الرسالة بعد 5 ثوانٍ
    setTimeout(() => {
        alert.remove();
    }, 5000);
}

// وظيفة الهروب من HTML
function escapeHtml(str) {
    return String(str || '').replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');
}