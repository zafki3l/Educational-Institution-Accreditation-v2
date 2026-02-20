<div id="createStandardModal" class="modal">
    <div class="modal-overlay"></div>

    <div class="modal-content">
        <div class="modal-header">
            <h2>Thêm tiêu chuẩn mới</h2>
            <button class="modal-close" id="closeStandardModal">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>

        <form id="createStandardForm"
              action="/standards"
              method="post"
              class="context-form">

            <input type="hidden"
                   name="CSRF-token"
                   value="<?= $_SESSION['CSRF-token'] ?? '' ?>">

            <div class="form-row">
                <div class="form-group">
                    <label for="id">Mã tiêu chuẩn *</label>
                    <input type="text"
                           id="id"
                           name="id"
                           placeholder="Nhập mã tiêu chuẩn"
                           class="form-input">
                </div>

                <div class="form-group">
                    <label for="department_id">Phòng ban *</label>
                    <select id="department_id"
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
                <label for="name">Tên tiêu chuẩn *</label>
                <input type="text"
                       id="name"
                       name="name"
                       class="form-input"
                       placeholder="Nhập tên tiêu chuẩn">
            </div>

            <div class="error" id="standardFormErrors"></div>

            <div class="form-actions">
                <button type="button"
                        class="btn-outline"
                        id="cancelStandardModal">
                    Hủy
                </button>

                <button type="submit"
                        class="btn-primary">
                    Thêm tiêu chuẩn
                </button>
            </div>
        </form>
    </div>
</div>

<script src="/js/standard/createForm.js"></script>
