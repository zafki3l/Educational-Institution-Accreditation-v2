document.addEventListener("DOMContentLoaded", () => {
    const editCriteriaModal = document.getElementById("editCriteriaModal");
    const closeEditModal = document.getElementById("closeEditModal");
    const cancelEditModal = document.getElementById("cancelEditModal");
    const editCriteriaForm = document.getElementById("editCriteriaForm");

    const editButtons = document.querySelectorAll(".edit-criteria-btn");


    if (!editCriteriaModal || !editCriteriaForm) return;

    editButtons.forEach(btn => {
        btn.addEventListener("click", async () => {
            const id = btn.dataset.id;

            try {
                const response = await fetch(`/criterias/${id}/edit`, {
                    headers: { Accept: 'application/json' }
                });

                if (!response.ok) throw new Error();

                const criteria = await response.json();
                fillCriteriaForm(criteria);

                clearEditErrors();
                editCriteriaModal.classList.add("active");
            } catch (e) {
                alert("Không tải được dữ liệu Criteria");
                console.error(e);
            }
        });
    });

    editCriteriaForm.addEventListener("submit", async (e) => {
        e.preventDefault();

        const response = await fetch(editCriteriaForm.action, {
            method: "POST",
            body: new FormData(editCriteriaForm),
            headers: { Accept: "application/json" }
        });

        const data = await response.json();

        if (response.ok && !data.errors) {
            editCriteriaModal.classList.remove("active");
            location.reload();
            return;
        }

        renderEditErrors(data.errors);
        editCriteriaModal.classList.add("active");
    });

    const closeEditForm = () => {
        editCriteriaModal.classList.remove("active");
        clearEditErrors();
    };

    closeEditModal?.addEventListener("click", closeEditForm);
    cancelEditModal?.addEventListener("click", closeEditForm);
});

const fillCriteriaForm = (criteria) => {
    console.log(criteria.id);
    console.log(criteria.standard_id);
    document.getElementById("edit-code").value = criteria.id;
    document.getElementById("edit-id").value = criteria.id;
    document.getElementById("edit-standard_id").value = String(criteria.standard_id ?? "");
    document.getElementById("edit-name").value = criteria.name;
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