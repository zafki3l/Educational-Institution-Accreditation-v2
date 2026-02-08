<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professional Admin Dashboard</title>
    <link rel="stylesheet" href="<?= HOST ?>/css/dashboard/admin.dashboard.css">
</head>
<body>

<main class="layout">
    <section class="card-grid">

        <div class="card">
            <div class="card-body">
                <h2>Quản lý người dùng</h2>
                <p class="subtitle">
                    Quản trị nhân sự, phòng ban và phân quyền hệ thống.
                </p>

                <div class="grid-2">
                    <div class="item">
                        <h4>Tài khoản</h4>
                        <span>1,240 Active</span>
                    </div>

                    <div class="item">
                        <h4>Phòng ban</h4>
                        <span>12 Departments</span>
                    </div>

                    <div class="item">
                        <h4>Nhân viên</h4>
                        <span>HR Records</span>
                    </div>

                    <div class="item">
                        <h4>Phân quyền</h4>
                        <span>8 System Roles</span>
                    </div>
                </div>
            </div>

            <div class="card-footer">
                Cập nhật 5 phút trước
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h2>Tiêu chuẩn & Đánh giá</h2>
                <p class="subtitle">
                    Theo dõi các cột mốc tiêu chuẩn và minh chứng đánh giá.
                </p>

                <div class="grid-2">
                    <div class="item">
                        <h4>Tiêu chuẩn</h4>
                        <span>Framework Setup</span>
                    </div>
                    <div class="item">
                        <h4>Tiêu chí</h4>
                        <span>Evaluation Rules</span>
                    </div>
                    <div class="item">
                        <h4>Cột mốc</h4>
                        <span>24 Milestones</span>
                    </div>
                    <div class="item">
                        <h4>Minh chứng</h4>
                        <span>142 Files</span>
                    </div>
                </div>
            </div>

            <div class="card-footer">
                85% Hoàn thành tổng thể
            </div>
        </div>

    </section>

<section class="stats-section">

    <div class="stats-header">
        <h3>Thống kê hệ thống</h3>
        <div class="filter-buttons">
            <button>7 ngày qua</button>
            <button class="active">Tháng này</button>
        </div>
    </div>

    <div class="stats-grid">
        <div class="stats-card large">
            <div class="stats-card-header">
                <div>
                    <h4>Hiệu suất tổ chức</h4>
                    <p class="subtitle">Tỉ lệ hoàn thành công việc theo tuần</p>
                </div>
                <div class="increase">
                    <span class="percent">+12.5%</span>
                    <br>
                    <small>Tăng so với tháng trước</small>
                </div>
            </div>

            <div class="bar-chart">
                <div class="bar" style="height:65%"><span>Thứ 2</span></div>
                <div class="bar" style="height:45%"><span>Thứ 3</span></div>
                <div class="bar" style="height:85%"><span>Thứ 4</span></div>
                <div class="bar" style="height:70%"><span>Thứ 5</span></div>
                <div class="bar" style="height:95%"><span>Thứ 6</span></div>
                <div class="bar gray" style="height:30%"><span>Thứ 7</span></div>
                <div class="bar gray" style="height:25%"><span>CN</span></div>
            </div>
        </div>

        <div class="stats-card">
            <h4>Minh chứng đánh giá</h4>
            <p class="subtitle">Trạng thái phê duyệt tài liệu</p>

            <div class="donut">
                <div class="donut-inner">
                    <strong>75%</strong>
                    <span>Hoàn tất</span>
                </div>
            </div>

            <div class="donut-info">
                <div>
                    <small>Duyệt</small>
                    <strong>106</strong>
                </div>
                <div>
                    <small>Chờ</small>
                    <strong>24</strong>
                </div>
                <div>
                    <small>Từ chối</small>
                    <strong class="danger">12</strong>
                </div>
            </div>
        </div>
    </div>
</section>


</main>

</body>
</html>
