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
    <link rel="stylesheet" href="/css/pagination.css">
</head>
<body>

<div class="layout">
    <?php include dirname(__DIR__, 4) . '/Shared/Views/layouts/user-management/sidebar.php' ?>

    <main class="main">
        <div class="container">

            <div class="page-header">
                <h1>Cập nhật vai trò</h1>
                <button class="primary-btn" id="openUserModal">
                    </span>THÊM VAI TRÒ
                </button>
            </div>

            <div class="table-box">
                <?php include 'components/roleTable.php' ?>
            </div>
        </div>
    </main>
</div>

</body>
</html>