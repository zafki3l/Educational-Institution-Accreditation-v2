document.addEventListener("DOMContentLoaded", () => {

    const editUserModal = document.getElementById("editUserModal");
    const closeEditModal = document.getElementById("closeEditModal");
    const cancelEditModal = document.getElementById("cancelEditModal");
    const editUserForm = document.getElementById("editUserForm");

    const editButtons = document.querySelectorAll(".edit-user-btn");

    if (!editUserModal || !editUserForm) return;

    editButtons.forEach(btn => {
        btn.addEventListener("click", async () => {
            const id = btn.dataset.id;

            try {
                const response = await fetch(`/users/${id}/edit`, {
                    headers: { Accept: 'application/json' }
                });

                if (!response.ok) throw new Error();

                const user = await response.json();
                fillUserForm(user);

                clearEditErrors();
                editUserModal.classList.add("active");
            } catch (e) {
                alert("Không tải được dữ liệu user");
                console.error(e);
            }
        });
    });

    editUserForm.addEventListener("submit", async (e) => {
        e.preventDefault();

        const response = await fetch(editUserForm.action, {
            method: "POST",
            body: new FormData(editUserForm),
            headers: { Accept: "application/json" }
        });

        const data = await response.json();

        if (response.ok && !data.errors) {
            editUserModal.classList.remove("active");
            location.reload();
            return;
        }

        renderEditErrors(data.errors);
        editUserModal.classList.add("active");
    });

    const closeEditForm = () => {
        editUserModal.classList.remove("active");
        clearEditErrors();
    };

    closeEditModal?.addEventListener("click", closeEditForm);
    cancelEditModal?.addEventListener("click", closeEditForm);
});

const fillUserForm = (user) => {
    document.getElementById("edit-id").value = user.id;
    document.getElementById("edit-first_name").value = user.first_name;
    document.getElementById("edit-last_name").value = user.last_name;
    document.getElementById("edit-email").value = user.email;
    document.getElementById("edit-role_id").value = user.role_id;
}

const renderEditErrors = (errors = []) => {
    const box = document.getElementById("editFormErrors");
    if (!box) return;

    box.innerHTML = "";

    errors.forEach(err => {
        const span = document.createElement("span");
        span.className = "error-message";
        span.textContent = `- ${err}`;
        box.appendChild(span);
    });
};

const clearEditErrors = () => {
    const box = document.getElementById("editFormErrors");
    if (box) box.innerHTML = "";
};  