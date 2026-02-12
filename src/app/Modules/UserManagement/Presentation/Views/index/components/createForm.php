<!-- Modal Thêm Người Dùng -->
<div id="userModal" class="modal">
    <div class="modal-overlay"></div>
    <div class="modal-content">
        <div class="modal-header">
            <h2>Thêm Người Dùng Mới</h2>
            <button class="modal-close" id="closeUserModal">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        <form id="userForm" action="/users" method="post" class="user-form">
            <input type="hidden" name="CSRF-token" value="<?= $_SESSION['CSRF-token'] ?? '' ?>">
            
            <div class="form-row">
                <div class="form-group">
                    <label for="first_name">Họ *</label>
                    <input 
                        type="text" 
                        id="first_name"
                        name="first_name" 
                        placeholder="Nhập họ" 
                        required
                        class="form-input"
                        value="<?= htmlspecialchars($_SESSION['old']['first_name'] ?? '') ?>"
                    >
                    <span class="error-message" id="error_first_name"></span>
                </div>

                <div class="form-group">
                    <label for="last_name">Tên *</label>
                    <input 
                        type="text" 
                        id="last_name"
                        name="last_name" 
                        placeholder="Nhập tên" 
                        required
                        class="form-input"
                        value="<?= htmlspecialchars($_SESSION['old']['last_name'] ?? '') ?>"
                    >
                    <span class="error-message" id="error_last_name"></span>
                </div>
            </div>

            <div class="form-row">
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
                    <span class="error-message" id="error_email">
                        <?= $_SESSION['errors']['email-exists'] ?? '' ?>
                    </span>
                </div>

                <div class="form-group">
                    <label for="role_id">Vai Trò *</label>
                    <select 
                        id="role_id"
                        name="role_id" 
                        required
                        class="form-input"
                    >
                        <option value="">-- Chọn vai trò --</option>
                        <?php foreach ($roles as $role): ?>
                            <option value="<?= $role->id ?>"
                                <?= (($_SESSION['old']['role_id'] ?? '') == $role->id) ? 'selected' : '' ?>>
                                <?= $role->name ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <span class="error-message" id="error_role_id"></span>
                </div>
            </div>

            <div class="form-group">
                <label for="password">Mật Khẩu *</label>
                <input 
                    type="password" 
                    id="password"
                    name="password" 
                    placeholder="Nhập mật khẩu (tối thiểu 8 ký tự)" 
                    required
                    minlength="8"
                    class="form-input"
                >
                <span class="error-message" id="error_password"></span>
            </div>

            <div class="form-actions">
                <button type="button" class="btn-outline" id="cancelUserModal">Hủy</button>
                <button type="submit" class="btn-primary">Thêm Người Dùng</button>
            </div>
        </form>
    </div>
</div>

<?php if (!empty($_SESSION['open_modal']) && $_SESSION['open_modal'] === 'create-user'): ?>
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('userModal').classList.add('open');
});
</script>
<?php endif; ?>