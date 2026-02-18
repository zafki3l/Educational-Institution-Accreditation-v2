<form action="/criterias" method="post">
    <input type="hidden" name="CSRF-token" value="<?= $_SESSION['CSRF-token'] ?>">

    <input type="text" name="id" placeholder="Nhập mã tiêu chuẩn">
    <input type="text" name="name" placeholder="Nhập tên tiêu chuẩn">
    <select name="standard_id" id="standard_id">
        <?php foreach ($standards as $standard): ?>
            <option value="<?= htmlspecialchars($standard->id) ?>"><?= htmlspecialchars($standard->name) ?></option>
        <?php endforeach; ?>
    </select>

    <button type="submit">Submit</button>
</form>