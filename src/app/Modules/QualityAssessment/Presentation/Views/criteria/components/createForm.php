<div id="createCriteriaModal" class="modal">
    <div class="modal-overlay"></div>
    <div class="modal-content">
        <div class="modal-header">
            <h2>Thêm tiêu chí mới</h2>
            <button class="modal-close" id="closeCriteriaModal">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        <form id="createCriteriaForm" action="/criterias" method="post" class="context-form">
            <input type="hidden" name="CSRF-token" value="<?= $_SESSION['CSRF-token'] ?? '' ?>">
            
            <div class="form-row">
                <div class="form-group">
                    <label for="id">Mã tiêu chí *</label>
                    <input 
                        type="text" 
                        id="id"
                        name="id" 
                        placeholder="Nhập mã tiêu chí (VD: 1.1)" 
                        class="form-input"
                    >
                </div>

                <div class="form-group">
                    <label for="standard_id">Tiêu chuẩn *</label>
                    <select 
                        id="standard_id"
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
                <textarea name="name" class="form-textarea" id=""></textarea>
            </div>

            <div class="error" id="formErrors"></div>
            
            <div class="form-actions">
                <button type="button" class="btn-outline" id="cancelCriteriaModal">Hủy</button>
                <button type="submit" class="btn-primary">Thêm tiêu chí</button>
            </div>
        </form>
    </div>
</div>

<script src="/js/criteria/createForm.js"></script>