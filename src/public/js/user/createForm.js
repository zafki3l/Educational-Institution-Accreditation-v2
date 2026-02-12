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
    // Clear session data when closing modal
    fetch('/users/clear-session', { method: 'POST' })
        .catch(err => console.error('Failed to clear session:', err));
};

closeUserModalBtn.addEventListener('click', closeModal);
cancelUserModalBtn.addEventListener('click', closeModal);

// Đóng modal khi click ngoài
userModal.addEventListener('click', (e) => {
    if (e.target === userModal || e.target.classList.contains('modal-overlay')) {
        closeModal();
    }
});
