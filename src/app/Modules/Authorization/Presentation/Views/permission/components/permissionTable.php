<table>
    <thead>
        <tr>
            <th>Mã quyền</th>
            <th>Tên quyền</th>
            <th class="right">Thao tác</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($permissions as $permission): ?>
            <tr>
                <td><?= htmlspecialchars($permission->id) ?></td>
                <td><?= htmlspecialchars($permission->name) ?></td>
                <td class="right">
                <form action="/permissions/<?= htmlspecialchars($permission->id) ?>" method="post">
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