<header>
    <div class="nav-bar">
        <ul class="left-nav">
            <li>
                <img src="http://localhost/assets/icon/fbu.png">
            </li>
            <li><a href="">Trang chủ</a></li>
            <li><a href="">Tìm kiếm minh chứng</a></li>

            <li><a href="">Admin Dashboard</a></li> <!--show dashboard for admin-->

            <li><a href="">Staff Dashboard</a></li> <!--Show dashboard for staff-->
        </ul>

        <ul class="right-nav">
            <li><a href="">Tài khoản của tôi</a></li>
            <li>
                <a href="#" onclick="document.getElementById('logoutForm').submit(); return false;">Đăng xuất</a>
            </li>
            <form id="logoutForm" action="" method="post" style="display:none;">
                <input type="hidden" name="CSRF-token" value="<?= $_SESSION['CSRF-token'] ?>">
                <input type="hidden" name="logout" value="1">
            </form>
            <li><a href="">Đăng nhập</a></li>
        </ul>
    </div>
</header>