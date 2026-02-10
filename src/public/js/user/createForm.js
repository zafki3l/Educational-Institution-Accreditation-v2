// Modal Management
const userModal = document.getElementById('userModal');
const openUserModalBtn = document.getElementById('openUserModal');
const closeUserModalBtn = document.getElementById('closeUserModal');
const cancelUserModalBtn = document.getElementById('cancelUserModal');
const userForm = document.getElementById('userForm');

// Mở modal
openUserModalBtn.addEventListener('click', () => {
    userModal.classList.add('active');
    userForm.reset();
    clearErrors();
});

// Đóng modal
const closeModal = () => {
    userModal.classList.remove('active');
};

closeUserModalBtn.addEventListener('click', closeModal);
cancelUserModalBtn.addEventListener('click', closeModal);

// Đóng modal khi click ngoài
userModal.addEventListener('click', (e) => {
    if (e.target === userModal || e.target.classList.contains('modal-overlay')) {
        closeModal();
    }
});

// Submit form tạo người dùng
userForm.addEventListener('submit', async (e) => {
    e.preventDefault();

    const formData = new FormData(userForm);

    try {
        const response = await fetch('/users', {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(Object.fromEntries(formData))
        });

        const data = await response.json();

        if (!response.ok) {
            // Xử lý lỗi validation
            if (data.errors) {
                Object.keys(data.errors).forEach(field => {
                    const errorElement = document.getElementById(`error_${field}`);
                    if (errorElement) {
                        errorElement.textContent = data.errors[field][0];
                        document.getElementById(field).classList.add('has-error');
                    }
                });
            } else {
                alert(data.message || 'Có lỗi xảy ra');
            }
            return;
        }

        // Thành công
        alert('Tạo người dùng mới thành công!');
        closeModal();
        userForm.reset();
        window.location.reload();
    } catch (error) {
        console.error('Error:', error);
        alert('Có lỗi xảy ra: ' + error.message);
    }
});

// Clear errors
function clearErrors() {
    const errorElements = userForm.querySelectorAll('.error-message');
    errorElements.forEach(el => {
        el.textContent = '';
    });

    const inputs = userForm.querySelectorAll('.form-input.has-error');
    inputs.forEach(input => {
        input.classList.remove('has-error');
    });
}

// Clear errors khi user bắt đầu nhập
userForm.addEventListener('input', (e) => {
    const field = e.target;
    const errorElement = document.getElementById(`error_${field.name}`);
    if (errorElement) {
        errorElement.textContent = '';
        field.classList.remove('has-error');
    }
});