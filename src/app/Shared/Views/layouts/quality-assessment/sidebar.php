<aside class="sidebar">
    <nav>
        <p class="sidebar-title">QUẢN LÝ BỘ TIÊU CHUẨN ĐÁNH GIÁ</p>

        <a class="sidebar-item" href="/standards">Quản lý tiêu chuẩn đánh giá</a>
        <a class="sidebar-item" href="/criterias">Quản lý tiêu chí đánh giá</a>

        <div class="sidebar-group">
            <div class="sidebar-item sidebar-toggle">
                Quản lý minh chứng đánh giá
                <span class="material-symbols-outlined toggle-icon">
                    expand_more
                </span>
            </div>

            <div class="sidebar-sub">
                <?php if (isset($standards) && !empty($standards)): ?>
                    <ul class="sidebar-tree">
                        <?php foreach ($standards as $standard): ?>
                            <li class="sidebar-standard">
                                <button
                                    type="button"
                                    class="sidebar-standard-toggle"
                                    data-target="standard-<?= htmlspecialchars($standard->id) ?>"
                                >
                                    <span class="material-symbols-outlined toggle-icon">
                                        expand_more
                                    </span>
                                    <span class="sidebar-standard-code">
                                        Tiêu chuẩn <?= htmlspecialchars($standard->id) ?>
                                    </span>
                                </button>

                                <?php $criterias = $standard->criteria ?? []; ?>
                                <?php if (!empty($criterias)): ?>
                                    <ul
                                        id="standard-<?= htmlspecialchars($standard->id) ?>"
                                        class="sidebar-criteria-list"
                                    >
                                        <?php foreach ($criterias as $criteria): ?>
                                            <li class="sidebar-criteria">
                                                <a
                                                    class="sidebar-criteria-link"
                                                    href="/criterias/<?= htmlspecialchars($criteria->id) ?>/evidences"
                                                >
                                                    <span class="sidebar-criteria-code">
                                                        Tiêu chí <?= htmlspecialchars($criteria->id) ?>
                                                    </span>
                                                </a>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p class="sidebar-empty">
                        Chưa có dữ liệu tiêu chuẩn/tiêu chí để hiển thị.
                    </p>
                <?php endif; ?>

                <a class="sidebar-item" href="/evidences">Mở trang quản lý minh chứng</a>
            </div>
        </div>
    </nav>
</aside>

<script src="/js/sidebar.js"></script>