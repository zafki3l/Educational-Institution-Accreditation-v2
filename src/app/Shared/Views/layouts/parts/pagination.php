<nav class="pagination-wrapper">
    <div class="pagination-container">
        <!-- Previous Button -->
        <div class="pagination-nav">
            <?php if ($pagination->currentPage > 1): ?>
                <a href="?page=1" class="pagination-btn pagination-first" title="First Page">
                    <span>«</span>
                </a>
                <a href="?page=<?= $pagination->currentPage - 1 ?>" class="pagination-btn pagination-prev" title="Previous Page">
                    <span>‹</span>
                </a>
            <?php else: ?>
                <span class="pagination-btn pagination-first disabled" title="First Page">«</span>
                <span class="pagination-btn pagination-prev disabled" title="Previous Page">‹</span>
            <?php endif; ?>
        </div>

        <!-- Page Numbers -->
        <div class="pagination-numbers">
            <?php 
                $startPage = max(1, $pagination->currentPage - 2);
                $endPage = min($pagination->lastPage, $pagination->currentPage + 2);
                
                if ($startPage > 1):
            ?>
                <a href="?page=1" class="pagination-number">1</a>
                <?php if ($startPage > 2): ?>
                    <span class="pagination-ellipsis">...</span>
                <?php endif; ?>
            <?php endif; ?>

            <?php for ($page = $startPage; $page <= $endPage; $page++): ?>
                <?php if ($page == $pagination->currentPage): ?>
                    <span class="pagination-number active"><?= $page ?></span>
                <?php else: ?>
                    <a href="?page=<?= $page ?>" class="pagination-number"><?= $page ?></a>
                <?php endif; ?>
            <?php endfor; ?>

            <?php 
                if ($endPage < $pagination->lastPage):
                    if ($endPage < $pagination->lastPage - 1):
            ?>
                        <span class="pagination-ellipsis">...</span>
                    <?php endif; ?>
                    <a href="?page=<?= $pagination->lastPage ?>" class="pagination-number"><?= $pagination->lastPage ?></a>
                <?php endif; ?>
        </div>

        <!-- Next Button -->
        <div class="pagination-nav">
            <?php if ($pagination->currentPage < $pagination->lastPage): ?>
                <a href="?page=<?= $pagination->currentPage + 1 ?>" class="pagination-btn pagination-next" title="Next Page">
                    <span>›</span>
                </a>
                <a href="?page=<?= $pagination->lastPage ?>" class="pagination-btn pagination-last" title="Last Page">
                    <span>»</span>
                </a>
            <?php else: ?>
                <span class="pagination-btn pagination-next disabled" title="Next Page">›</span>
                <span class="pagination-btn pagination-last disabled" title="Last Page">»</span>
            <?php endif; ?>
        </div>
    </div>
</nav>