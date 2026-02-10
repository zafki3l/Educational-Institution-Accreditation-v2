document.addEventListener("DOMContentLoaded", function () {

    const deleteModal = document.getElementById("deleteUserModal");
    const cancelBtn = document.getElementById("cancelDeleteModal");
    const confirmBtn = document.getElementById("confirmDeleteBtn");

    document.querySelectorAll(".delete-user-btn").forEach(btn => {
        btn.addEventListener("click", function () {

            const userId = this.dataset.id;
            const userName = this.dataset.name;

            document.getElementById("delete_user_id").value = userId;
            document.getElementById("delete_user_name").textContent = userName;

            deleteModal.classList.add("active");
        });
    });

    const closeModal = () => {
        deleteModal.classList.remove("active");
    };

    cancelBtn.addEventListener("click", closeModal);

    deleteModal.addEventListener("click", function (e) {
        if (e.target === deleteModal || e.target.classList.contains("modal-overlay")) {
            closeModal();
        }
    });

    confirmBtn.addEventListener("click", async function () {

        const userId = document.getElementById("delete_user_id").value;

        confirmBtn.disabled = true;
        confirmBtn.textContent = "Đang xóa...";

        try {
            const response = await fetch(`/users/${userId}`, {
                method: "DELETE",
                headers: {
                    "X-Requested-With": "XMLHttpRequest"
                }
            });

            if (response.ok) {
                window.location.replace("/users");
            } else {
                alert("Không thể xóa người dùng.");
            }

        } catch (err) {
            alert("Lỗi kết nối máy chủ.");
        }

        confirmBtn.disabled = false;
        confirmBtn.textContent = "Xác Nhận Xóa";
    });

});
