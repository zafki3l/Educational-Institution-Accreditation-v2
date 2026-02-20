document.addEventListener('DOMContentLoaded', () => {
    const createUserForm = document.getElementById('createUserForm');
    const createUserModal = document.getElementById('createUserModal');
    const openBtn = document.getElementById('openUserModal');
    const closeBtn = document.getElementById('closeUserModal');
    const cancelBtn = document.getElementById('cancelUserModal');

    const roleSelect = document.getElementById('role_id');
    const departmentSelect = document.getElementById('department_id');
    const ROLE_STAFF = '2';

    if (!createUserForm || !createUserModal || !openBtn) return;
    if (!roleSelect || !departmentSelect) return;

    openBtn.addEventListener('click', () => {
        createUserModal.classList.add('active');
    });

    const close = () => {
        createUserModal.classList.remove('active');
        clearErrors();
        createUserForm.reset();
    }

    closeBtn?.addEventListener('click', close);
    cancelBtn?.addEventListener('click', close);

    createUserForm.addEventListener('submit', async (e) => {
        e.preventDefault();

        const response = await fetch(createUserForm.action, {
            method: 'POST',
            body: new FormData(createUserForm),
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
        createUserModal.classList.add('active');
    });

    roleSelect.addEventListener('change', function () {
        if (this.value === ROLE_STAFF) {
            departmentSelect.disabled = false;
            departmentSelect.required = true;
        } else {
            departmentSelect.disabled = true;
            departmentSelect.required = false;
            departmentSelect.value = '';
        }
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