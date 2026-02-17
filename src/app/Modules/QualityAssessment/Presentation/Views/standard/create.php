<form action="/standards" method="post">
    <input type="hidden" name="CSRF-token" value="<?= $_SESSION['CSRF-token'] ?>">

    <input type="text" name="id" placeholder="Nhập mã tiêu chuẩn">
    <input type="text" name="name" placeholder="Nhập tên tiêu chuẩn">
    <select name="department_id" id="department_id">
        <?php foreach ($departments as $department): ?>
            <option value="<?= htmlspecialchars($department->id) ?>"><?= htmlspecialchars($department->name) ?></option>
        <?php endforeach; ?>
    </select>

    <button type="submit">Submit</button>
</form>