document.addEventListener('DOMContentLoaded', () => {
    const createStaffForm = document.getElementById('createStaffForm');
    const createStaffModal = document.getElementById('createStaffModal');
    const openBtn = document.getElementById('openStaffModal');
    const closeBtn = document.getElementById('closeStaffModal');
    const cancelBtn = document.getElementById('cancelStaffModal');

    if (!createStaffForm || !createStaffModal || !openBtn) return;

    openBtn.addEventListener('click', () => {
        createStaffModal.classList.add('active');
    });

    const close = () => {
        createStaffModal.classList.remove('active');
        clearErrors();
        createStaffForm.reset();
    }

    closeBtn?.addEventListener('click', close);
    cancelBtn?.addEventListener('click', close);

    createStaffForm.addEventListener('submit', async (e) => {
        e.preventDefault();

        const response = await fetch(createStaffForm.action, {
            method: 'POST',
            body: new FormData(createStaffForm),
            headers: { Accept: 'application/json' }
        });

        const text = await response.text();

        let data = {};
        try {
            data = JSON.parse(text);
        } catch {
            console.error('Invalid JSON:', text);
            return;
        }

        if (response.ok && !data.errors) {
            close();
            location.reload();
            return;
        }

        renderErrors(data.errors);
        createStaffModal.classList.add('active');
    });
});

function renderErrors(errors = []) {
    const box = document.getElementById('formErrors');
    if (!box) return;

    box.innerHTML = '';

    errors.forEach(err => {
        const span = document.createElement('span');
        span.className = 'error-message';
        span.textContent = `- ${err}`;
        box.appendChild(span);
    });
}

function clearErrors() {
    const box = document.getElementById('formErrors');
    if (!box) return;
    box.innerHTML = '';
}
