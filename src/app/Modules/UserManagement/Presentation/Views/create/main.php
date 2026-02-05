<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>THÊM NGƯỜI DÙNG MỚI</h1>

    <form action="" method="post">
        <input type="hidden" name="CSRF-token" value="<?= $_SESSION['CSRF-token'] ?>">
        <input type="text" name="auth_id" placeholder="Mã xác thực">
        <input type="text" name="first_name" placeholder="Họ">
        <input type="text" name="last_name" placeholder="Tên">
        <input type="text" name="email" placeholder="Email">
        <input type="password" name="password" placeholder="Mật khẩu">
        <select name="role_id">
            <?php foreach ($roles as $role): ?>
                <option 
                    value="<?= htmlspecialchars($role->id) ?>">
                    <?= htmlspecialchars($role->name) ?>
                </option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Thêm</button>
    </form>
</body>
</html>