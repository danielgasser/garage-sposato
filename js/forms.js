/* ============================================
   Garage Sposato — Form Handler (client-side)
   ============================================ */

document.addEventListener('DOMContentLoaded', () => {
// ─── Show/hide "Andere" brand field ─────────────

    document.querySelectorAll('select[name="car_brand"]').forEach(select => {
        const otherField = select.closest('.row').querySelector('.brand-other-field');
        if (!otherField) return;

        select.addEventListener('change', () => {
            if (select.value === 'Andere') {
                otherField.style.display = '';
                otherField.querySelector('input').setAttribute('required', '');
            } else {
                otherField.style.display = 'none';
                otherField.querySelector('input').removeAttribute('required');
                otherField.querySelector('input').value = '';
                otherField.querySelector('input').classList.remove('is-invalid');
            }
        });
    });
    // ─── Form submission ────────────────────────────

    document.querySelectorAll('.sposato-form').forEach(form => {

        form.addEventListener('submit', async (e) => {
            e.preventDefault();

            clearValidation(form);
            const feedback = getFeedback(form);
            feedback.className = 'form-feedback';
            feedback.textContent = '';

            if (!validateForm(form)) return;

            form.classList.add('is-submitting');

            try {
                const response = await fetch('/include/elements/submit.php', {
                    method: 'POST',
                    body: new FormData(form),
                });
                const text = await response.text();

                const data = JSON.parse(text);

                // Update CSRF token
                if (data.csrf) {
                    form.querySelector('input[name="_csrf"]').value = data.csrf;
                }

                feedback.classList.add('show', data.status);
                feedback.textContent = data.message;

                if (data.status === 'success') {
                    const csrf = data.csrf;
                    const formId = form.dataset.formId;

                    form.reset();

                    // Restore hidden fields after reset
                    if (csrf) form.querySelector('input[name="_csrf"]').value = csrf;
                    form.querySelector('input[name="form_id"]').value = formId;

                    // Auto-close modal after 3 seconds
                    setTimeout(() => {
                        const modal = form.closest('.sposato-modal');
                        if (modal) closeModal(modal);

                    }, 3000);
                }

            } catch (err) {
                feedback.classList.add('show', 'error');
                feedback.textContent = 'Verbindungsfehler. Bitte versuchen Sie es erneut.';
            } finally {
                form.classList.remove('is-submitting');
            }
        });
    });

    // ─── Validation ─────────────────────────────────

    function validateForm(form) {
        let valid = true;

        form.querySelectorAll('[required]').forEach(field => {
            if (!field.value.trim()) {
                field.classList.add('is-invalid');
                valid = false;
            }
        });

        const email = form.querySelector('input[type="email"]');
        if (email && email.value && !isValidEmail(email.value)) {
            email.classList.add('is-invalid');
            valid = false;
        }

        const phone = form.querySelector('input[type="tel"]');
        if (phone && phone.value && !isValidPhone(phone.value)) {
            phone.classList.add('is-invalid');
            valid = false;
        }

        if (!valid) {
            const first = form.querySelector('.is-invalid');
            if (first) first.focus();

            const feedback = getFeedback(form);
            feedback.classList.add('show', 'error');
            feedback.textContent = 'Bitte füllen Sie alle Pflichtfelder korrekt aus.';
        }

        return valid;
    }

    function clearValidation(form) {
        form.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
    }

    function isValidEmail(email) {
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
    }

    function isValidPhone(phone) {
        return /^[\d\s\+\-\(\)]{8,20}$/.test(phone);
    }

    // ─── Live validation (remove error on input) ────

    document.querySelectorAll('.sposato-form .form-control, .sposato-form .form-select').forEach(field => {
        field.addEventListener('input', () => {
            field.classList.remove('is-invalid');
        });
    });

    // ─── Custom Modal ───────────────────────────────

    document.querySelectorAll('[data-modal-target]').forEach(trigger => {
        trigger.addEventListener('click', (e) => {
            e.preventDefault();
            const modal = document.getElementById(trigger.dataset.modalTarget);
            if (!modal) return;
            modal.classList.add('show');
            modal.style.display = 'block';
            document.body.classList.add('modal-open');
        });
    });

    document.querySelectorAll('.btn-close').forEach(btn => {
        btn.addEventListener('click', () => {
            const modal = btn.closest('.sposato-modal');
            if (modal) closeModal(modal);
        });
    });

    document.querySelectorAll('.sposato-modal').forEach(modal => {
        modal.addEventListener('click', (e) => {
            if (e.target === modal) closeModal(modal);
        });
    });

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            const open = document.querySelector('.sposato-modal.show');
            if (open) closeModal(open);
        }
    });

    function closeModal(modal) {
        modal.classList.remove('show');
        modal.style.display = 'none';
        document.body.classList.remove('modal-open');

        const form = modal.querySelector('.sposato-form');
        if (!form) return;
        const csrf = form.querySelector('input[name="_csrf"]').value;
        const formId = form.dataset.formId;
        form.reset();
        clearValidation(form);
        form.querySelector('input[name="_csrf"]').value = csrf;
        form.querySelector('input[name="form_id"]').value = formId;
        const feedback = getFeedback(form);
        feedback.className = 'form-feedback';
        feedback.textContent = '';
    }

    function getFeedback(form) {
        const id = form.dataset.feedback;
        return id ? document.getElementById(id) : getFeedback(form);
    }
});
