<table>
    <thead>
        <tr>
            <th>Họ và tên</th>
            <th>Email</th>
            <th>Phòng ban</th>
            <th class="right">Thao tác</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($staffs as $staff): ?>
            <tr>
                <td><?= htmlspecialchars("{$staff->first_name} {$staff->last_name}") ?></td>
                <td><?= htmlspecialchars($staff->email) ?></td>
                <td><?= htmlspecialchars($staff->department_name ?? '') ?></td>
                <td class="right">
                    <div class="action-group">
                        <button class="icon-btn edit-staff-btn"
                                type="button"
                                title="Chỉnh sửa"
                                data-id="<?= $staff->id ?>">
                            <span class="material-symbols-outlined">edit</span>
                        </button>

                        <form action="/staffs/<?= htmlspecialchars($staff->id) ?>" method="post">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="CSRF-token" value="<?= $_SESSION['CSRF-token'] ?>">

                            <button class="icon-btn danger" title="Xóa" type="submit">
                                <span class="material-symbols-outlined">delete</span>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>