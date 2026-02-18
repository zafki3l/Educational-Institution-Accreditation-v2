<table class="criteria-table">
    <thead>
        <tr>
            <th>Mã tiêu chí</th>
            <th>Tên tiêu chí</th>
            <th class="right">Thao tác</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($standards as $standard): ?>
            <!-- STANDARD HEADER ROW -->
            <tr class="standard-row"
                data-standard-id="<?= $standard->id ?>">
                <td colspan="3">
                    <button class="toggle-btn"
                            data-standard-id="<?= $standard->id ?>"
                            aria-expanded="true">
                        <span class="material-symbols-outlined toggle-icon">
                            expand_more
                        </span>
                    </button>
                    <strong>
                        Tiêu chuẩn <?= $standard->id ?>:
                        <?= htmlspecialchars($standard->name) ?>
                    </strong>
                </td>
            </tr>

            <!-- CRITERIA ROWS -->
            <?php foreach ($standard->criteria as $criteria): ?>
                <tr class="criteria-row"
                    data-parent-standard="<?= $standard->id ?>">
                    <td><?= htmlspecialchars($criteria->id) ?></td>
                    <td class="criteria-name"
                        title="<?= htmlspecialchars($criteria->name) ?>">
                        <?= htmlspecialchars($criteria->name) ?>
                    </td>
                    <td class="right">
                        <div class="action-group">
                            <button class="icon-btn edit-standard-btn"
                                    type="button"
                                    title="Chỉnh sửa"
                                    data-id="<?= $criteria->id ?>">
                                <span class="material-symbols-outlined">edit</span>
                            </button>

                            <form action="/standards/<?= htmlspecialchars($criteria->id) ?>" method="post">
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
        <?php endforeach; ?>
    </tbody>
</table>

<script src="/js/criteria/criteriaTable.js"></script>