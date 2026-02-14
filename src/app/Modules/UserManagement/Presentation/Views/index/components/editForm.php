<div id="editUserModal" class="modal">
    <div class="modal-overlay"></div>

    <div class="modal-content">
        <div class="modal-header">
            <h2>Sửa Thông Tin Người Dùng</h2>
            <button class="modal-close" id="closeEditModal">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>

        <form id="editUserForm" class="user-form" action="/users/update" method="post">
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" id="edit-id" name="id" value="<?= htmlspecialchars($_SESSION['old']['id'] ?? '') ?>">
            <input type="hidden" name="CSRF-token" value="<?= $_SESSION['CSRF-token'] ?>">
            <div class="form-row">
                <div class="form-group">
                    <label for="edit-first_name">Họ</label>
                    <input 
                        type="text"
                        id="edit-first_name"
                        name="first_name"
                        class="form-input"
                        value="<?= htmlspecialchars($_SESSION['old']['first_name'] ?? '') ?>"
                    >
                </div>

                <div class="form-group">
                    <label for="edit-last_name">Tên</label>
                    <input 
                        type="text"
                        id="edit-last_name"
                        name="last_name"
                        class="form-input"
                        value="<?= htmlspecialchars($_SESSION['old']['last_name'] ?? '') ?>"
                    >
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="edit-email">Email</label>
                    <input 
                        type="text"
                        id="edit-email"
                        name="email"
                        class="form-input"
                        value="<?= htmlspecialchars($_SESSION['old']['email'] ?? '') ?>"
                    >
                </div>

                <div class="form-group">
                    <label for="edit-role_id">Vai Trò</label>
                    <select 
                        id="edit-role_id"
                        name="role_id"
                        class="form-input"
                    >
                        <option value="<?= null ?>">-- Chọn vai trò --</option>
                        <?php foreach ($roles as $role): ?>
                            <option value="<?= $role->id ?>"
                                <?= (($_SESSION['old']['role_id'] ?? '') == $role->id) ? 'selected' : '' ?>>
                                <?= $role->name ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="error" id="editFormErrors"></div>

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