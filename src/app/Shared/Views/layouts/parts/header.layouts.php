<header>
    <div class="nav-bar">
        <ul class="left-nav">
            <li>
                <img src="http://localhost/assets/icon/fbu.png">
            </li>
            <li><a href="<?= HOST ?>">Trang chủ</a></li>
            <li><a href="">Tìm kiếm minh chứng</a></li>

            <li><a href="">Admin Dashboard</a></li> <!--show dashboard for admin-->

            <li><a href="">Staff Dashboard</a></li> <!--Show dashboard for staff-->
        </ul>

        <ul class="right-nav">
            <li><a href="">Tài khoản của tôi</a></li>
            <?php if (isAuth()): ?>
                <li>
                    <a href="#" onclick="document.getElementById('logoutForm').submit(); return false;">Đăng xuất</a>
                </li>
                <form id="logoutForm" action="<?= HOST ?>/logout" method="post" style="display:none;">
                    <input type="hidden" name="CSRF-token" value="<?= $_SESSION['CSRF-token'] ?>">
                    <input type="hidden" name="logout" value="1">
                </form>
            <?php else: ?>
                <li><a href="<?= HOST ?>/login">Đăng nhập</a></li>
            <?php endif; ?>
        </ul>
    </div>
</header>