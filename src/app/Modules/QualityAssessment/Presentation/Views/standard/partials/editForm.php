<div id="editStandardModal" class="modal">
    <div class="modal-overlay"></div>

    <div class="modal-content">
        <div class="modal-header">
            <h2>Sửa tiêu chuẩn</h2>
            <button class="modal-close" id="closeEditStandardModal">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>

        <form id="editStandardForm"
              method="post"
              class="context-form">

            <input type="hidden" name="_method" value="PUT">
            <input type="hidden"
                   name="CSRF-token"
                   value="<?= $_SESSION['CSRF-token'] ?? '' ?>">

            <div class="form-row">
                <div class="form-group">
                    <label for="edit_id">Mã tiêu chuẩn</label>
                    <input type="text"
                           id="edit_id"
                           name="id"
                           class="form-input"
                           readonly>
                </div>

                <div class="form-group">
                    <label for="edit_department_id">Phòng ban *</label>
                    <select id="edit_department_id"
                            name="department_id"
                            class="form-input">
                        <option value="">-- Chọn phòng ban --</option>
                        <?php foreach ($departments as $department): ?>
                            <option value="<?= $department->id ?>">
                                <?= htmlspecialchars($department->name) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="edit_name">Tên tiêu chuẩn *</label>
                <input type="text"
                       id="edit_name"
                       name="name"
                       class="form-input"
                       placeholder="Nhập tên tiêu chuẩn">
            </div>

            <div class="error" id="editStandardFormErrors"></div>

            <div class="form-actions">
                <button type="button"
                        class="btn-outline"
                        id="cancelEditStandardModal">
                    Hủy
                </button>

                <button type="submit"
                        class="btn-primary">
                    Cập nhật
                </button>
            </div>
        </form>
    </div>
</div>
