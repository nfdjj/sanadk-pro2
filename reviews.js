const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

// تحميل جدول الآراء
async function loadReviewsTable() {
    const tableBody = document.getElementById('reviews-table-body');
    const statsCount = document.getElementById('reviews-total');
    if (!tableBody || !statsCount) {
        return;
    }

    try {
        const response = await fetch('/opinions');
        const reviews = await response.json();

        if (!Array.isArray(reviews) || reviews.length === 0) {
            tableBody.innerHTML = `
                <tr>
                    <td colspan="6" style="text-align: center; padding: 40px;">
                        <i class="fas fa-comment-slash" style="font-size: 2.5rem; color: #a7b2c0; margin-bottom: 15px;"></i>
                        <p style="color: #a7b2c0; font-size: 1.1rem;">لا توجد آراء بعد</p>
                    </td>
                </tr>
            `;
            statsCount.textContent = '0';
            return;
        }

        tableBody.innerHTML = reviews.map((review, index) => {
            const date = review.created_at ? new Date(review.created_at).toLocaleDateString('en-GB') : '';
            return `
                <tr>
                    <td>${index + 1}</td>
                    <td class="review-name">${escapeHtml(review.name)}</td>
                    <td class="review-rating">
                        <span class="stars">${'★'.repeat(review.rating || 0)}${'☆'.repeat(5 - (review.rating || 0))}</span>
                        <span class="rating-number">(${review.rating || 0}/5)</span>
                    </td>
                    <td class="review-comment">${escapeHtml(review.opinion)}</td>
                    <td class="review-date">${escapeHtml(date)}</td>
                    <td class="review-actions">
                        <button class="action-btn delete-btn" data-id="${review.id}">
                            <i class="fas fa-trash"></i> حذف
                        </button>
                    </td>
                </tr>
            `;
        }).join('');

        statsCount.textContent = String(reviews.length);
    } catch (error) {
        console.error('Failed to load reviews:', error);
        tableBody.innerHTML = `
            <tr>
                <td colspan="6" style="text-align: center; padding: 40px; color: #a7b2c0;">
                    حدث خطأ أثناء تحميل الآراء
                </td>
            </tr>
        `;
        statsCount.textContent = '0';
    }
}

// حذف رأي
async function deleteReview(id) {
    try {
        const response = await fetch(`/opinions/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': csrfToken || '',
                'Accept': 'application/json'
            }
        });

        if (!response.ok) {
            throw new Error('خطأ في حذف الرأي');
        }

        // remove the row from the DOM (if present)
        try {
            const btn = document.querySelector(`button.delete-btn[data-id="${id}"]`);
            if (btn) {
                const row = btn.closest('tr');
                if (row) row.remove();
            }
            // update counter if present
            if (reviewsTotalCount) {
                const current = parseInt(reviewsTotalCount.textContent || '0', 10) || 0;
                reviewsTotalCount.textContent = String(Math.max(0, current - 1));
            }
        } catch (e) { /* ignore DOM removal errors */ }

        showToast('تم حذف الرأي بنجاح', 'success');
    } catch (error) {
        console.error(error);
        showToast('حدث خطأ أثناء حذف الرأي', 'error');
    }
}

// عرض رسالة تنبيه
function showAlert(message, type = 'success') {
    // backward compatibility: call new toast
    showToast(message, type);
}

// nicer toast/toast-style alert used across admin reviews
function showToast(message, type = 'success') {
    const colors = {
        success: { bg: '#d4edda', color: '#155724', icon: 'check-circle' },
        error: { bg: '#f8d7da', color: '#721c24', icon: 'exclamation-circle' }
    };
    const cfg = colors[type] || colors.success;

    const toast = document.createElement('div');
    toast.className = 'review-toast';
    toast.style.position = 'fixed';
    toast.style.top = '20px';
    toast.style.right = '20px';
    toast.style.zIndex = 99999;
    toast.style.background = cfg.bg;
    toast.style.color = cfg.color;
    toast.style.padding = '12px 16px';
    toast.style.borderRadius = '8px';
    toast.style.boxShadow = '0 6px 20px rgba(0,0,0,0.12)';
    toast.style.display = 'flex';
    toast.style.alignItems = 'center';
    toast.style.gap = '10px';
    toast.innerHTML = `<i class="fas fa-${cfg.icon}" style="font-size:18px"></i><div style="font-size:14px">${message}</div>`;

    const closeBtn = document.createElement('button');
    closeBtn.textContent = '×';
    closeBtn.style.marginLeft = '8px';
    closeBtn.style.border = 'none';
    closeBtn.style.background = 'transparent';
    closeBtn.style.color = cfg.color;
    closeBtn.style.fontSize = '18px';
    closeBtn.style.cursor = 'pointer';
    closeBtn.addEventListener('click', () => toast.remove());
    toast.appendChild(closeBtn);

    document.body.appendChild(toast);
    setTimeout(() => { try { toast.remove(); } catch (e) {} }, 4500);
}

// وظيفة الهروب من HTML
function escapeHtml(str) {
    return String(str || '').replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');
}

const reviewsTableBody = document.getElementById('reviews-table-body');
const reviewsTotalCount = document.getElementById('reviews-total');
if (reviewsTableBody && reviewsTotalCount) {
    reviewsTableBody.addEventListener('click', function(event) {
        const target = event.target.closest('.delete-btn');
        if (!target) return;
        const id = target.dataset.id;
        if (!id) return;
        if (confirm('هل أنت متأكد من حذف هذا الرأي؟')) {
            deleteReview(id);
        }
    });
    loadReviewsTable();
}
