<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Management Dashboard</title>
    <link rel="stylesheet" href="staff-management.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
    <link rel="stylesheet" href="/css/sidebar.css?<?= SYSTEM_VERSION ?>">
    <link rel="stylesheet" href="/css/index/index.css?<?= SYSTEM_VERSION ?>">
    <link rel="stylesheet" href="/css/index/createUser.css?<?= SYSTEM_VERSION ?>">
    <link rel="stylesheet" href="/css/pagination.css?<?= SYSTEM_VERSION ?>">
    <link rel="stylesheet" href="/css/components/modal.css?<?= SYSTEM_VERSION ?>">
</head>
<body>

<div class="layout">
    <?php include dirname(__DIR__, 5) . '/Shared/Web/Views/layouts/quality-assessment/sidebar.php' ?>

    <main class="main">
        <div class="container">

            <div class="page-header">
                <h1><?= htmlspecialchars($header) ?></h1>

                <?php if (isAdmin()): ?>
                    <button class="primary-btn" id="openStandardModal">
                        THÊM TIÊU CHUẨN
                    </button>
                <?php endif; ?>
            </div>

            <div class="table-box">
                <?php include 'partials/standardTable.php' ?>
            </div>
        </div>
    </main>
</div>

<?php include 'partials/createForm.php'; ?>
<?php include 'partials/editForm.php'; ?>
<?php include 'partials/deleteForm.php'; ?>

<script src="/js/standard/editForm.js"></script>
<script src="/js/standard/deleteForm.js"></script>

<div id="toast-container" style="position: fixed; top: 20px; right: 20px; z-index: 10000; display: flex; flex-direction: column; gap: 10px;"></div>

</body>
</html>