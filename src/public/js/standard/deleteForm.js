document.addEventListener('DOMContentLoaded', () => {
    const deleteStandardModal = document.getElementById('deleteStandardModal');
    const closeBtn = document.getElementById('closeDeleteStandardModal');
    const cancelBtn = document.getElementById('cancelDeleteStandardModal');
    const confirmBtn = document.getElementById('confirmDeleteStandardBtn');

    if (!deleteStandardModal) return;

    const close = () => {
        deleteStandardModal.classList.remove('active');
    };

    closeBtn?.addEventListener('click', close);
    cancelBtn?.addEventListener('click', close);

    document.querySelectorAll('.delete-standard-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            const id = btn.dataset.id;
            const name = btn.dataset.name;

            document.getElementById('delete_standard_id').value = id;
            document.getElementById('delete_standard_name').textContent = name;

            deleteStandardModal.classList.add('active');
        });
    });

    confirmBtn?.addEventListener('click', async () => {
        const id = document.getElementById('delete_standard_id').value;
        const csrfToken = document.getElementById('delete_standard_csrf_token').value;

        const formData = new FormData();
        formData.append('_method', 'DELETE');
        formData.append('CSRF-token', csrfToken);

        const response = await fetch(`/standards/${id}`, {
            method: 'POST',
            body: formData,
            headers: { Accept: 'application/json' }
        });

        if (response.ok) {
            close();
            window.location.replace("/standards?success=delete");
        } else {
            const data = await response.json();
            alert(data.errors ? data.errors.join('\n') : 'Có lỗi xảy ra khi xóa tiêu chuẩn.');
        }
    });
});
