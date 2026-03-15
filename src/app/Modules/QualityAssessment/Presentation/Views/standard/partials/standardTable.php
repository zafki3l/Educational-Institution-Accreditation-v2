<table>
    <thead>
        <tr>
            <th>Mã tiêu chuẩn</th>
            <th>Tên tiêu chuẩn</th>
            <th>Phòng ban</th>
            <?php if (isAdmin()): ?>
                <th class="right">Thao tác</th>
            <?php endif; ?>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($standards as $standard): ?>
            <tr>
                <td><?= htmlspecialchars($standard->id) ?></td>
                <td><?= htmlspecialchars($standard->name) ?></td>
                <td><?= htmlspecialchars($standard->department->name ?? '') ?></td>

                <?php if (isAdmin()): ?>
                    <td class="right">
                        <div class="action-group">
                            <button class="icon-btn edit-standard-btn"
                                    type="button"
                                    title="Chỉnh sửa"
                                    data-id="<?= htmlspecialchars($standard->id) ?>"
                                    data-name="<?= htmlspecialchars($standard->name) ?>"
                                    data-department-id="<?= htmlspecialchars($standard->department_id) ?>">
                                <span class="material-symbols-outlined">edit</span>
                            </button>

                            <button class="icon-btn danger delete-standard-btn"
                                    type="button"
                                    title="Xóa"
                                    data-id="<?= htmlspecialchars($standard->id) ?>"
                                    data-name="<?= htmlspecialchars($standard->name) ?>">
                                <span class="material-symbols-outlined">delete</span>
                            </button>
                        </div>
                    </td>
                <?php endif; ?>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>