<div id="deleteUserModal" class="modal">
    <div class="modal-overlay"></div>

    <div class="modal-content modal-sm">

        <div class="modal-header delete-header">
            <div class="delete-header-left">
                <div class="delete-icon">
                    <span class="material-symbols-outlined">warning</span>
                </div>
                <h2>Xác Nhận Xóa</h2>
            </div>
        </div>

        <div class="modal-body delete-body">
            <p>
                Bạn có chắc chắn muốn xóa người dùng 
                <strong id="delete_user_name"></strong>?
            </p>

            <p class="text-muted">
                Hành động này không thể hoàn tác và dữ liệu sẽ bị xóa vĩnh viễn.
            </p>

            <input type="hidden" id="delete_user_id">
        </div>

        <div class="modal-actions">
            <button type="button" class="btn-outline" id="cancelDeleteModal">
                Hủy
            </button>

            <button type="button" class="btn-danger" id="confirmDeleteBtn">
                Xác Nhận Xóa
            </button>
        </div>

    </div>
</div>
