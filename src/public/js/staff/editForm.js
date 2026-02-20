document.addEventListener("DOMContentLoaded", () => {
    const editStaffModal = document.getElementById("editStaffModal");
    const closeEditModal = document.getElementById("closeEditModal");
    const cancelEditModal = document.getElementById("cancelEditModal");
    const editStaffForm = document.getElementById("editStaffForm");

    const editButtons = document.querySelectorAll(".edit-staff-btn");

    if (!editStaffModal || !editStaffForm) return;

    editButtons.forEach(btn => {
        btn.addEventListener("click", async () => {
            const id = btn.dataset.id;

            try {
                const response = await fetch(`/staffs/${id}/edit`, {
                    headers: { Accept: 'application/json' }
                });

                if (!response.ok) throw new Error();

                const staff = await response.json();
                fillStaffForm(staff);

                clearEditErrors();
                editStaffModal.classList.add("active");
            } catch (e) {
                alert("Không tải được dữ liệu nhân viên");
                console.error(e);
            }
        });
    });

    editStaffForm.addEventListener("submit", async (e) => {
        e.preventDefault();

        const response = await fetch(editStaffForm.action, {
            method: "POST",
            body: new FormData(editStaffForm),
            headers: { Accept: "application/json" }
        });

        const data = await response.json();

        if (response.ok && !data.errors) {
            editStaffModal.classList.remove("active");
            location.reload();
            return;
        }

        renderEditErrors(data.errors);
        editStaffModal.classList.add("active");
    });

    const closeEditForm = () => {
        editStaffModal.classList.remove("active");
        clearEditErrors();
    };

    closeEditModal?.addEventListener("click", closeEditForm);
    cancelEditModal?.addEventListener("click", closeEditForm);
});

const fillStaffForm = (staff) => {
    document.getElementById("edit-id").value = staff.id;
    document.getElementById("edit-first_name").value = staff.first_name;
    document.getElementById("edit-last_name").value = staff.last_name;
    document.getElementById("edit-email").value = staff.email;
    document.getElementById("edit-department_id").value = staff.department_id ?? '';
};

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
