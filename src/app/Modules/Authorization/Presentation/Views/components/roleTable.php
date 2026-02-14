<table>
    <thead>
        <tr>
            <th>Mã vai trò</th>
            <th>Tên vai trò</th>
            <th class="right">Thao tác</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($roles as $role): ?>
            <tr>
                <td><?= htmlspecialchars($role->id) ?></td>
                <td><span class="badge"><?= htmlspecialchars($role->name) ?></span></td>
                <td class="right">
                    <button class="icon-btn edit-user-btn"
                            type="button"
                            title="Chỉnh sửa">
                        <span class="material-symbols-outlined">edit</span>
                    </button>
                    <button class="icon-btn danger" title="Xóa" type="submit">
                        <span class="material-symbols-outlined">delete</span>
                    </button>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>