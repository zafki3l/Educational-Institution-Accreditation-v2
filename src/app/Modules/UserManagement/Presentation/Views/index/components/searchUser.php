 <div class="filter-box">
     <input type="text" placeholder="Tìm kiếm người dùng...">
     <select>
        <option>Tất cả vai trò</option>
        <?php foreach ($roles as $role): ?>
            <option value="<?= htmlspecialchars($role->id) ?>">
                <?= htmlspecialchars($role->name) ?>
            </option>
        <?php endforeach; ?>
     </select>
 </div>