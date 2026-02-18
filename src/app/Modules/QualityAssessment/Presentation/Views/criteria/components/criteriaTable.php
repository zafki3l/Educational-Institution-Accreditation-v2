<table class="criteria-table">
    <thead>
        <tr>
            <th>Mã tiêu chí</th>
            <th>Tên tiêu chí</th>
            <th class="right">Các mốc đánh giá</th>
            <th class="right">Thao tác</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($standards as $standard): ?>
            <!-- STANDARD HEADER ROW -->
            <tr class="standard-row"
                data-standard-id="<?= $standard->id ?>">
                <td colspan="4">
                    <strong>
                        Tiêu chuẩn <?= $standard->id ?>:
                        <?= htmlspecialchars($standard->name) ?>
                    </strong>

                    <button class="toggle-btn"
                            data-standard-id="<?= $standard->id ?>"
                            aria-expanded="true">
                        <span class="material-symbols-outlined toggle-icon">
                            expand_more
                        </span>
                    </button>
                </td>
            </tr>

            <!-- CRITERIA ROWS -->
            <?php foreach ($standard->criteria as $criteria): ?>
                <tr class="criteria-row"
                    data-parent-standard="<?= $standard->id ?>">
                    <td>Tiêu chí <?= htmlspecialchars($criteria->id) ?></td>
                    <td class="criteria-name"
                        title="<?= htmlspecialchars($criteria->name) ?>">
                        <?= htmlspecialchars($criteria->name) ?>
                    </td>
                    <td class="right">
                        <button class="milestone-btn" type="button"><span class="material-symbols-outlined">fact_check</span></button>
                    </td>
                    <td class="right">
                        <div class="action-group">
                            <button class="icon-btn edit-standard-btn"
                                    type="button"
                                    title="Chỉnh sửa"
                                    data-id="<?= $criteria->id ?>">
                                <span class="material-symbols-outlined">edit</span>
                            </button>

                            <form action="/criterias/<?= htmlspecialchars($criteria->id) ?>" method="post">
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