<div id="editStaffModal" class="modal">
    <div class="modal-overlay"></div>

    <div class="modal-content">
        <div class="modal-header">
            <h2>Sửa Thông Tin Nhân Viên</h2>
            <button class="modal-close" id="closeEditModal">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>

        <form id="editStaffForm" class="user-form" action="/staffs/update" method="post">
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

            <br>

            <div class="form-group">
                <label for="edit-department_id">Phòng ban</label>
                <select 
                    id="edit-department_id"
                    name="department_id" 
                    class="form-input"
                >
                    <option value="">-- Chọn phòng ban --</option>
                    <?php foreach ($departments as $department): ?>
                        <option value="<?= $department->id ?>"
                            <?= (($_SESSION['old']['department_id'] ?? '') == $department->id) ? 'selected' : '' ?>>
                            <?= $department->name ?>
                        </option>
                    <?php endforeach; ?>
                </select>
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
    </div>
</div>