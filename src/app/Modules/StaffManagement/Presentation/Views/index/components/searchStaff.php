<form method="get" class="filter-box">
    <input 
        type="text" 
        name="keyword" 
        placeholder="Tìm kiếm nhân viên..."
        value="<?= htmlspecialchars($_GET['keyword'] ?? '') ?>"
    >

    <select name="role_id">
        <option value="">Tất cả phòng ban</option>
        <?php foreach ($departments as $department): ?>
            <option 
                value="<?= $department->id ?>"
                <?= (($_GET['department_id'] ?? '') == $department->id) ? 'selected' : '' ?>
            >
                <?= htmlspecialchars($department->name) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <button type="submit">Tìm kiếm</button>
</form>