<div id="editUserModal" class="modal">
    <div class="modal-overlay"></div>

    <div class="modal-content">
        <div class="modal-header">
            <h2>Sửa Thông Tin Người Dùng</h2>
            <button class="modal-close" id="closeEditModal">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>

        <form id="editUserForm" class="user-form">
            <input type="hidden" id="edit-id" name="id">

            <div class="form-row">
                <div class="form-group">
                    <label for="edit-first_name">Họ *</label>
                    <input 
                        type="text"
                        id="edit-first_name"
                        name="first_name"
                        class="form-input"
                        required
                    >
                    <span class="error-message" id="edit_error_first_name"></span>
                </div>

                <div class="form-group">
                    <label for="edit-last_name">Tên *</label>
                    <input 
                        type="text"
                        id="edit-last_name"
                        name="last_name"
                        class="form-input"
                        required
                    >
                    <span class="error-message" id="edit_error_last_name"></span>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="edit-email">Email</label>
                    <input 
                        type="email"
                        id="edit-email"
                        name="email"
                        class="form-input"
                    >
                    <span class="error-message" id="edit_error_email"></span>
                </div>

                <div class="form-group">
                    <label for="edit-role_id">Vai Trò *</label>
                    <select 
                        id="edit-role_id"
                        name="role_id"
                        class="form-input"
                        required
                    >
                        <option value="">-- Chọn vai trò --</option>
                        <?php foreach ($roles as $role): ?>
                            <option value="<?= htmlspecialchars($role->id) ?>">
                                <?= htmlspecialchars($role->name) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <span class="error-message" id="edit_error_role_id"></span>
                </div>
            </div>

            <div class="form-actions">
                <button type="button" class="btn-outline" id="cancelEditModal">
                    Hủy
                </button>
                <button type="submit" class="btn-primary">
                    Cập Nhật
                </button>
            </div>
        </form>
    </div>
</div>
