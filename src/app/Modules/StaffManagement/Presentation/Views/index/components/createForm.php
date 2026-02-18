<div id="createStaffModal" class="modal">
    <div class="modal-overlay"></div>
    <div class="modal-content">
        <div class="modal-header">
            <h2>Thêm Nhân Viên Mới</h2>
            <button class="modal-close" id="closeStaffModal">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        <form id="createStaffForm" action="/staffs" method="post" class="context-form">
            <input type="hidden" name="CSRF-token" value="<?= $_SESSION['CSRF-token'] ?? '' ?>">
            
            <div class="form-row">
                <div class="form-group">
                    <label for="first_name">Họ *</label>
                    <input 
                        type="text" 
                        id="first_name"
                        name="first_name" 
                        placeholder="Nhập họ" 
                        class="form-input"
                        value="<?= htmlspecialchars($_SESSION['old']['first_name'] ?? '') ?>"
                    >
                </div>

                <div class="form-group">
                    <label for="last_name">Tên *</label>
                    <input 
                        type="text" 
                        id="last_name"
                        name="last_name" 
                        placeholder="Nhập tên" 
                        class="form-input"
                        value="<?= htmlspecialchars($_SESSION['old']['last_name'] ?? '') ?>"
                    >
                </div>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input 
                    type="email" 
                    id="email"
                    name="email" 
                    placeholder="Nhập email" 
                    class="form-input"
                    value="<?= htmlspecialchars($_SESSION['old']['email'] ?? '')?>"
                >
            </div>

            <br>

            <div class="form-group">
                <label for="department_id">Phòng ban</label>
                <select 
                    id="department_id"
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
            
            <br>
            
            <div class="form-group">
                <label for="password">Mật Khẩu *</label>
                <input 
                    type="password" 
                    id="password"
                    name="password" 
                    placeholder="Nhập mật khẩu (tối thiểu 8 ký tự)" 
                    class="form-input"
                >
            </div>

            <div class="error" id="formErrors"></div>
            
            <div class="form-actions">
                <button type="button" class="btn-outline" id="cancelStaffModal">Hủy</button>
                <button type="submit" class="btn-primary">Thêm Nhân Viên</button>
            </div>
        </form>
    </div>
</div>