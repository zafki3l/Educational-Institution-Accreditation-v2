<div id="editCriteriaModal" class="modal">
    <div class="modal-overlay"></div>

    <div class="modal-content">
        <div class="modal-header">
            <h2>Sửa thông tin tiêu chí</h2>
            <button class="modal-close" id="closeEditModal">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>

        <form id="editCriteriaForm" class="context-form" action="/criterias/update" method="post">
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" id="edit-id" name="id" value="<?= htmlspecialchars($_SESSION['old']['id'] ?? '') ?>">
            <input type="hidden" name="CSRF-token" value="<?= $_SESSION['CSRF-token'] ?>">

            <div class="form-row">
                <div class="form-group">
                    <label for="id">Mã tiêu chí *</label>
                    <input 
                        type="text"
                        id="edit-code"
                        class="form-input"
                        readonly
                    >
                </div>

                <div class="form-group">
                    <label for="standard_id">Tiêu chuẩn *</label>
                    <select 
                        id="edit-standard_id"
                        name="standard_id" 
                        class="form-input"
                    >
                        <option value="<?= null ?>">-- Chọn tiêu chuẩn --</option>
                        <?php foreach ($standards as $standard): ?>
                            <option 
                                value="<?= $standard->id ?>"
                                title="Tiêu chuẩn <?= htmlspecialchars($standard->id) ?>: <?= htmlspecialchars($standard->name) ?>"
                            >
                                <?= htmlspecialchars("Tiêu chuẩn {$standard->id}: " . mb_strimwidth($standard->name, 0, 20, '…')) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="name">Tên tiêu chí</label>
                <textarea name="name" class="form-textarea" id="edit-name"></textarea>
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

<script src="/js/criteria/editForm.js"></script>