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
                <form action="/roles/<?= htmlspecialchars($role->id) ?>" method="post">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="CSRF-token" value="<?= $_SESSION['CSRF-token'] ?>">

                    <button class="icon-btn danger" title="Xóa" type="submit">
                        <span class="material-symbols-outlined">delete</span>
                    </button>
                </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>