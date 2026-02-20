document.addEventListener('DOMContentLoaded', () => {

    const modal = document.getElementById('createStandardModal');
    const form = document.getElementById('createStandardForm');
    const openBtn = document.getElementById('openStandardModal');
    const closeBtn = document.getElementById('closeStandardModal');
    const cancelBtn = document.getElementById('cancelStandardModal');
    const errorBox = document.getElementById('standardFormErrors');

    if (!modal || !form || !openBtn) return;

    openBtn.addEventListener('click', () => {
        modal.classList.add('active');
    });

    const close = () => {
        modal.classList.remove('active');
        form.reset();
        clearErrors();
    };

    closeBtn?.addEventListener('click', close);
    cancelBtn?.addEventListener('click', close);

    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        const response = await fetch(form.action, {
            method: 'POST',
            body: new FormData(form),
            headers: { Accept: 'application/json' }
        });

        const data = await response.json();

        if (response.ok && !data.errors) {
            close();
            location.reload();
            return;
        }

        renderErrors(data.errors);
        modal.classList.add('active');
    });

    function renderErrors(errors = []) {
        errorBox.innerHTML = '';
        errors.forEach(err => {
            const span = document.createElement('span');
            span.className = 'error-message';
            span.textContent = `- ${err}`;
            errorBox.appendChild(span);
        });
    }

    function clearErrors() {
        errorBox.innerHTML = '';
    }

});