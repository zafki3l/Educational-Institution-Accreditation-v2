<div id="deleteStandardModal" class="modal">
    <div class="modal-overlay"></div>
    <div class="modal-content modal-small">
        <div class="modal-header">
            <h2>Xác nhận xóa</h2>
            <button class="modal-close" id="closeDeleteStandardModal">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        <div class="modal-body">
            <p>Bạn có chắc chắn muốn xóa tiêu chuẩn này?</p>
            <p id="delete_standard_name" style="font-weight: 600; margin: 10px 0; color: var(--text-primary);"></p>
            <p class="warning-text">Hành động này không thể hoàn tác.</p>

            <input type="hidden" id="delete_standard_id">
            <input type="hidden" id="delete_standard_csrf_token" value="<?= $_SESSION['CSRF-token'] ?? '' ?>">
        </div>
        <div class="modal-footer">
            <button type="button" class="btn-outline" id="cancelDeleteStandardModal">Hủy</button>
            <button type="button" class="btn-danger" id="confirmDeleteStandardBtn">Xóa</button>
        </div>
    </div>
</div>
