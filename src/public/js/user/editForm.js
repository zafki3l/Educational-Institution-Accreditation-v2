document.addEventListener("DOMContentLoaded", function () {

    const editModal = document.getElementById("editUserModal");
    const closeBtn = document.getElementById("closeEditModal");
    const cancelBtn = document.getElementById("cancelEditModal");
    const editForm = document.getElementById("editUserForm");

    const editButtons = document.querySelectorAll(".edit-user-btn");

    editButtons.forEach(btn => {
        btn.addEventListener("click", async function () {
            const id = this.dataset.id; // Get user id from button

            try {
                console.log("Edit ID:", id);
                const response = await fetch(`/users/${id}/edit`);

                if (!response.ok) {
                    throw new Error('Fetch user failed');
                }

                const user = await response.json();

                // Fill form
                document.getElementById("edit-id").value = user.id;
                document.getElementById("edit-first_name").value = user.first_name;
                document.getElementById("edit-last_name").value = user.last_name;
                document.getElementById("edit-email").value = user.email;
                document.getElementById("edit-role_id").value = user.role_id;

                // Mở modal
                editModal.classList.add("active");
            } catch (err) {
                alert("Không tải được dữ liệu user");
                console.error(err);
            }
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
