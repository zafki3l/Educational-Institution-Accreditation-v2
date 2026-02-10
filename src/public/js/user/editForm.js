document.addEventListener("DOMContentLoaded", function () {

    const editModal = document.getElementById("editUserModal");
    const closeBtn = document.getElementById("closeEditModal");
    const cancelBtn = document.getElementById("cancelEditModal");
    const editForm = document.getElementById("editUserForm");

    const editButtons = document.querySelectorAll(".edit-user-btn");

    editButtons.forEach(btn => {
        btn.addEventListener("click", function () {

            editForm.reset();

            document.getElementById("edit-id").value = this.dataset.id;
            document.getElementById("edit-first_name").value = this.dataset.firstname;
            document.getElementById("edit-last_name").value = this.dataset.lastname;
            document.getElementById("edit-email").value = this.dataset.email;
            document.getElementById("edit-role_id").value = this.dataset.role;

            editModal.classList.add("active");
        });
    });

    const closeModal = () => {
        editModal.classList.remove("active");
    };

    closeBtn.addEventListener("click", closeModal);
    cancelBtn.addEventListener("click", closeModal);

    editModal.addEventListener("click", (e) => {
        if (e.target === editModal || e.target.classList.contains("modal-overlay")) {
            closeModal();
        }
    });

});
