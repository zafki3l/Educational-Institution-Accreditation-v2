<table>
    <thead>
        <tr>
            <th>Mã phòng ban</th>
            <th>Tên phòng ban</th>
            <th class="right">Thao tác</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($departments as $department): ?>
            <tr>
                <td><?= htmlspecialchars($department->id) ?></td>
                <td><?= htmlspecialchars($department->name) ?></td>
                <td class="right">
                <form action="/departments/<?= htmlspecialchars($department->id) ?>" method="post">
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