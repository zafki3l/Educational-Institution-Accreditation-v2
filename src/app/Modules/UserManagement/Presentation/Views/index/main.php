<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Account Management Dashboard</title>
    <link rel="stylesheet" href="user-management.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
    <link rel="stylesheet" href="<?= HOST ?>/css/index/user.index.css">
</head>
<body>

<div class="layout">
    <aside class="sidebar">
        <nav>
            <p class="sidebar-title">QUẢN LÝ NGƯỜI DÙNG</p>

            <a class="sidebar-item active" href="">Quản lý tài khoản người dùng</a>
            <a class="sidebar-item" href="">Quản lý phòng ban</a>
            <a class="sidebar-item" href="">Quản lý nhân viên</a>
            <a class="sidebar-item" href="">Cập nhật quyền</a>
        </nav>
    </aside>

    <main class="main">
        <div class="container">

            <div class="page-header">
                <h1>Quản lý tài khoản người dùng</h1>
                <button class="primary-btn">
                    <span class="material-symbols-outlined">person_add</span>THÊM NGƯỜI DÙNG MỚI
                </button>
            </div>

            <div class="filter-box">
                <input type="text" placeholder="Tìm kiếm người dùng...">
                <select>
                    <option>Tất cả vai trò</option>
                    <option>Admin</option>
                    <option>Staff</option>
                </select>
            </div>

            <div class="table-box">
                <table>
                    <thead>
                        <tr>
                            <th>Họ và tên</th>
                            <th>Email</th>
                            <th>Vai trò</th>
                            <th class="right">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user): ?>
                            <tr>
                                <td><?= htmlspecialchars("{$user->first_name} {$user->last_name}") ?></td>
                                <td><?= htmlspecialchars($user->email) ?></td>
                                <td><span class="badge"><?= htmlspecialchars($user->role_name) ?></span></td>
                                <td class="right">
                                    <button class="icon-btn">
                                        <span class="material-symbols-outlined">edit</span>
                                    </button>
                                    <button class="icon-btn danger">
                                        <span class="material-symbols-outlined">delete</span>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

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

</body>
</html>