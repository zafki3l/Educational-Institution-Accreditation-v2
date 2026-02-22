<form method="get" class="filter-box">
    <input 
        type="text" 
        name="keyword" 
        placeholder="Tìm kiếm nhân viên..."
        value="<?= htmlspecialchars($_GET['keyword'] ?? '') ?>"
    >

    <button type="submit">Tìm kiếm</button>
</form>