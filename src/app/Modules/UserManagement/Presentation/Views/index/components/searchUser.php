<form method="get" class="filter-box">
    <input 
        type="text" 
        name="keyword" 
        placeholder="Tìm kiếm người dùng..."
        value="<?= htmlspecialchars($_GET['keyword'] ?? '') ?>"
    >

    <select name="role_id">
        <option value="">Tất cả vai trò</option>
        <?php foreach ($roles as $role): ?>
            <option 
                value="<?= $role->id ?>"
                <?= (($_GET['role_id'] ?? '') == $role->id) ? 'selected' : '' ?>
            >
                <?= htmlspecialchars($role->name) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <button type="submit">Lọc</button>
</form>