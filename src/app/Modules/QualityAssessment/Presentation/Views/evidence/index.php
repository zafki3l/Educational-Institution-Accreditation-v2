<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="staff-management.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
    <link rel="stylesheet" href="/css/sidebar.css">
    <link rel="stylesheet" href="/css/index/index.css">
    <link rel="stylesheet" href="/css/index/createUser.css">
    <link rel="stylesheet" href="/css/pagination.css">
    <link rel="stylesheet" href="/css/criteria/table.css">
</head>
<body>

<div class="layout">
    <?php include dirname(__DIR__, 5) . '/Shared/Views/layouts/quality-assessment/sidebar.php' ?>

    <main class="main">
        <div class="container">

            <div class="page-header">
                <h1>Quản lý tiêu chí đánh giá</h1>

                <button class="primary-btn" id="openCriteriaModal">
                    </span>THÊM TIÊU CHÍ MỚI
                </button>
            </div>

            <div class="table-box">
                
            </div>
        </div>
    </main>
</div>

</body>
</html>