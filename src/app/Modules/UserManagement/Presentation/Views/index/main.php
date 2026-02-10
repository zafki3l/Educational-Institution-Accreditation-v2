<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Account Management Dashboard</title>
    <link rel="stylesheet" href="user-management.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
    <link rel="stylesheet" href="/css/index/user.index.css">
    <link rel="stylesheet" href="/css/index/createUser.css">
</head>
<body>

<div class="layout">
    <?php include dirname(__DIR__, 5) . '/Shared/Views/layouts/user-management/sidebar.php' ?>

    <main class="main">
        <div class="container">

            <div class="page-header">
                <h1>Quản lý tài khoản người dùng</h1>
                <button class="primary-btn" id="openUserModal">
                    <span class="material-symbols-outlined">person_add</span>THÊM NGƯỜI DÙNG MỚI
                </button>
            </div>

           <?php include 'components/searchUser.php' ?>

            <div class="table-box">
                <?php include 'components/userTable.php' ?>

                <div class="pagination">
                    <span>Hiển thị 1 - 4 / 12 người dùng</span>
                    <div>
                        <button class="page-btn">‹</button>
                        <button class="page-btn">›</button>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<?php include 'components/createForm.php' ?>

<script src="/js/user/createForm.js"></script>

</body>
</html>