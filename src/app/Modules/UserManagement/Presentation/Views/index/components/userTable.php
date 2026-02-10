<table>
    <thead>
        <tr>
            <th>Họ và tên</th>
            <th>Email</th>
            <th>Vai trò</th>
            <th class="right">Thao tác</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= htmlspecialchars("{$user->first_name} {$user->last_name}") ?></td>
                <td><?= htmlspecialchars($user->email) ?></td>
                <td><span class="badge"><?= htmlspecialchars($user->role_name) ?></span></td>
                <td class="right">
                    <button class="icon-btn edit-user-btn"
                            title="Chỉnh sửa" data-id="<?= $user->id ?>"
                            data-firstname="<?= htmlspecialchars($user->first_name) ?>"
                            data-lastname="<?= htmlspecialchars($user->last_name) ?>"
                            data-email="<?= htmlspecialchars($user->email) ?>"
                            data-role="<?= htmlspecialchars($user->role_name) ?>">
                        <span class="material-symbols-outlined">edit</span>
                    </button>
                    <button class="icon-btn danger" title="Xóa">
                        <span class="material-symbols-outlined">delete</span>
                    </button>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>