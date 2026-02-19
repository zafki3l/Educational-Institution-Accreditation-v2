<div id="milestonesModal" class="modal">
    <div class="modal-overlay"></div>

    <div class="modal-box">
        <!-- Header -->
        <div class="modal-header">
            <div class="modal-header-left">
                <div class="modal-icon">
                    <span class="material-icons-round">assignment_turned_in</span>
                </div>
                <div>
                    <h3 class="modal-title">Các mốc đánh giá</h3>
                    <p class="modal-desc">
                        Lãnh đạo CSGD đảm bảo tầm nhìn và sứ mạng của CSGD đáp ứng được nhu cầu và sự hài lòng của các bên liên quan.
                    </p>
                </div>
            </div>

            <button class="modal-close" id="closeMilestonesModal">
                <span class="material-icons-round">close</span>
            </button>
        </div>

        <!-- Table -->
        <div class="modal-body">
            <table class="milestones-table">
                <thead>
                    <tr>
                        <th class="w-sm">Mốc</th>
                        <th>Tên mốc đánh giá</th>
                        <th class="right w-xs">Thao tác</th>
                    </tr>
                </thead>
                <tbody id="milestonesTableBody"></tbody>
            </table>
        </div>

        <!-- Empty -->
        <div id="emptyMilestonesState" class="empty-state">
            <span class="material-icons-round">fact_check</span>
            <p>Chưa có mốc đánh giá nào</p>
        </div>

        <!-- Footer -->
        <div class="modal-footer">
            <button class="btn-outline" id="closeMilestonesBtn">Đóng</button>
            <button class="btn-primary" id="addMilestoneBtn">
                <span class="material-icons-round">add</span>
                Thêm mốc đánh giá
            </button>
        </div>
    </div>
</div>

<style>
.modal.show {
    display: flex;
}

/* ===== MODAL BOX ===== */
.modal-box {
    position: relative;
    z-index: 50;
    width: 100%;
    max-width: 56rem;
    background: #fff;
    border-radius: 16px;
    border: 1px solid #e2e8f0;
    box-shadow: 0 20px 25px -5px rgba(0,0,0,.1);
    overflow: hidden;
}

/* ===== HEADER ===== */
.modal-header {
    display: flex;
    justify-content: space-between;
    gap: 16px;
    padding: 24px 32px;
    border-bottom: 1px solid #f1f5f9;
}

.modal-header-left {
    display: flex;
    gap: 16px;
}

.modal-icon {
    width: 48px;
    height: 48px;
    border-radius: 12px;
    background: #f0f4ff;
    color: #2563eb;
    display: flex;
    align-items: center;
    justify-content: center;
}

.modal-title {
    margin: 0;
    font-size: 20px;
    font-weight: 700;
    color: #1e293b;
}

.modal-desc {
    margin-top: 4px;
    font-size: 14px;
    color: #64748b;
    max-width: 640px;
}

.modal-close {
    background: none;
    border: none;
    color: #94a3b8;
    cursor: pointer;
}

.modal-close:hover {
    color: #475569;
}

/* ===== BODY ===== */
.modal-body {
    padding: 8px 32px;
}

.milestones-table {
    width: 100%;
    border-collapse: collapse;
}

.milestones-table th {
    padding: 20px;
    font-size: 11px;
    text-transform: uppercase;
    color: #94a3b8;
    border-bottom: 1px solid #f1f5f9;
}

.milestones-table td {
    padding: 16px 20px;
    border-top: 1px solid #f1f5f9;
}

.right {
    text-align: right;
}

.w-sm { width: 64px; }
.w-md { width: 192px; }
.w-xs { width: 96px; }

/* ===== EMPTY ===== */
.empty-state {
    display: none;
    padding: 64px 32px;
    text-align: center;
}

.empty-state span {
    font-size: 48px;
    color: #cbd5e1;
}

.empty-state p {
    color: #64748b;
    font-weight: 500;
}

/* ===== FOOTER ===== */
.modal-footer {
    padding: 24px 32px;
    background: #f8fafc;
    border-top: 1px solid #f1f5f9;
    display: flex;
    justify-content: flex-end;
    gap: 12px;
}

.btn-primary {
    padding: 10px 24px;
    border-radius: 12px;
    border: none;
    background: #1e40af;
    color: #fff;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 8px;
    cursor: pointer;
}

.btn-primary:hover {
    background: #1d4ed8;
}

.milestones-table tbody tr {
    transition: background .15s ease, box-shadow .15s ease;
}

.milestones-table tbody tr:hover {
    background: #f8fafc;
}

.milestones-table td:first-child {
    color: #94a3b8;
    font-weight: 600;
}

.milestones-table td {
    padding-top: 20px;
    padding-bottom: 20px;
}
</style>

<script src="/js/criteria/milestonesModal.js"></script>