<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Account Management Dashboard</title>
    <link rel="stylesheet" href="user-management.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
    <link rel="stylesheet" href="/css/sidebar.css">
    <link rel="stylesheet" href="/css/role/role.index.css">
</head>
<body>

<div class="layout">
    <?php include dirname(__DIR__, 5) . '/Shared/Views/layouts/user-management/sidebar.php' ?>

    <main class="main">
        <div class="container">
            <div class="page-header">
                <h1>Cập nhật quyền</h1>
                <form action="/permissions" method="post">
                    <input type="hidden" name="CSRF-token" value="<?= $_SESSION['CSRF-token'] ?>">
                    <input type="text" name="id" placeholder="Nhập mã quyền" class="text-input">
                    <input type="text" name="name" placeholder="Nhập tên quyền" class="text-input">

                    <button class="primary-btn" type="submit">
                        </span>THÊM QUYỀN
                    </button>
                </form>
            </div>

            <div class="table-box">
                <?php include 'components/permissionTable.php' ?>
            </div>
        </div>
    </main>
</div>

</body>
</html>