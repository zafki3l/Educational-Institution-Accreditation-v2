<!DOCTYPE html>
<html class="light" lang="vi">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Professional Admin Management Dashboard</title>
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,container-queries"></script>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        primary: "#1e40af",
                        "background-light": "#f8fafc",
                        "background-dark": "#0f172a",
                        "card-light": "#ffffff",
                        "card-dark": "#1e293b",
                    },
                    fontFamily: {
                        display: ["Inter", "sans-serif"],
                        sans: ["Inter", "sans-serif"],
                    },
                    borderRadius: {
                        DEFAULT: "0.75rem",
                    },
                },
            },
        };
    </script>
    <style type="text/tailwindcss">
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }#sidebar-drawer:checked ~ aside {
            transform: translateX(0);
        }
        #sidebar-drawer:checked ~ .drawer-overlay {
            opacity: 1;
            pointer-events: auto;
        }
    </style>
</head>

<body class="bg-background-light dark:bg-background-dark text-slate-900 dark:text-slate-100 transition-colors duration-300">
    <main class="min-h-screen flex flex-col">
        <div class="flex-1 p-8">
            <div class="max-w-[1600px] mx-auto space-y-8">
                <section>
                    <div class="flex justify-between items-end mb-6">
                        <h2 class="text-sm font-bold uppercase tracking-wider text-slate-400">Thống kê hệ thống</h2>
                        <div class="flex space-x-2">
                            <button class="px-3 py-1.5 text-xs font-medium bg-white dark:bg-card-dark border border-slate-200 dark:border-slate-700 rounded-lg hover:bg-slate-50 transition-colors">7 ngày qua</button>
                            <button class="px-3 py-1.5 text-xs font-medium bg-primary text-white rounded-lg">Tháng này</button>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
                        <div class="xl:col-span-2 bg-white dark:bg-card-dark p-6 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm">
                            <div class="flex justify-between items-center mb-8">
                                <div>
                                    <h3 class="font-bold text-lg">Hiệu suất tổ chức</h3>
                                    <p class="text-sm text-slate-500">Tỉ lệ hoàn thành công việc theo tuần</p>
                                </div>
                                <div class="text-right">
                                    <span class="text-2xl font-bold text-primary">+12.5%</span>
                                    <p class="text-xs text-emerald-500 font-medium">Tăng so với tháng trước</p>
                                </div>
                            </div>
                            <div class="flex items-end justify-between h-48 gap-4 px-2">
                                <div class="flex-1 flex flex-col items-center space-y-3 group">
                                    <div class="w-full bg-slate-50 dark:bg-slate-800/50 rounded-lg relative flex items-end overflow-hidden h-full">
                                        <div class="bg-primary/20 w-full h-full absolute"></div>
                                        <div class="bg-primary w-full h-[65%] rounded-t-lg transition-all duration-500 group-hover:brightness-110"></div>
                                    </div>
                                    <span class="text-[10px] text-slate-400 font-medium uppercase">Thứ 2</span>
                                </div>
                                <div class="flex-1 flex flex-col items-center space-y-3 group">
                                    <div class="w-full bg-slate-50 dark:bg-slate-800/50 rounded-lg relative flex items-end overflow-hidden h-full">
                                        <div class="bg-primary/20 w-full h-full absolute"></div>
                                        <div class="bg-primary w-full h-[45%] rounded-t-lg transition-all duration-500 group-hover:brightness-110"></div>
                                    </div>
                                    <span class="text-[10px] text-slate-400 font-medium uppercase">Thứ 3</span>
                                </div>
                                <div class="flex-1 flex flex-col items-center space-y-3 group">
                                    <div class="w-full bg-slate-50 dark:bg-slate-800/50 rounded-lg relative flex items-end overflow-hidden h-full">
                                        <div class="bg-primary/20 w-full h-full absolute"></div>
                                        <div class="bg-primary w-full h-[85%] rounded-t-lg transition-all duration-500 group-hover:brightness-110"></div>
                                    </div>
                                    <span class="text-[10px] text-slate-400 font-medium uppercase">Thứ 4</span>
                                </div>
                                <div class="flex-1 flex flex-col items-center space-y-3 group">
                                    <div class="w-full bg-slate-50 dark:bg-slate-800/50 rounded-lg relative flex items-end overflow-hidden h-full">
                                        <div class="bg-primary/20 w-full h-full absolute"></div>
                                        <div class="bg-primary w-full h-[70%] rounded-t-lg transition-all duration-500 group-hover:brightness-110"></div>
                                    </div>
                                    <span class="text-[10px] text-slate-400 font-medium uppercase">Thứ 5</span>
                                </div>
                                <div class="flex-1 flex flex-col items-center space-y-3 group">
                                    <div class="w-full bg-slate-50 dark:bg-slate-800/50 rounded-lg relative flex items-end overflow-hidden h-full">
                                        <div class="bg-primary/20 w-full h-full absolute"></div>
                                        <div class="bg-primary w-full h-[95%] rounded-t-lg transition-all duration-500 group-hover:brightness-110"></div>
                                    </div>
                                    <span class="text-[10px] text-slate-400 font-medium uppercase">Thứ 6</span>
                                </div>
                                <div class="flex-1 flex flex-col items-center space-y-3 group">
                                    <div class="w-full bg-slate-50 dark:bg-slate-800/50 rounded-lg relative flex items-end overflow-hidden h-full">
                                        <div class="bg-slate-200 dark:bg-slate-700 w-full h-[30%] rounded-t-lg transition-all duration-500"></div>
                                    </div>
                                    <span class="text-[10px] text-slate-400 font-medium uppercase">Thứ 7</span>
                                </div>
                                <div class="flex-1 flex flex-col items-center space-y-3 group">
                                    <div class="w-full bg-slate-50 dark:bg-slate-800/50 rounded-lg relative flex items-end overflow-hidden h-full">
                                        <div class="bg-slate-200 dark:bg-slate-700 w-full h-[25%] rounded-t-lg transition-all duration-500"></div>
                                    </div>
                                    <span class="text-[10px] text-slate-400 font-medium uppercase">CN</span>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white dark:bg-card-dark p-6 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm flex flex-col">
                            <h3 class="font-bold text-lg mb-1">Minh chứng đánh giá</h3>
                            <p class="text-sm text-slate-500 mb-8">Trạng thái phê duyệt tài liệu</p>
                            <div class="flex-1 flex flex-col items-center justify-center">
                                <div class="relative w-40 h-40 mb-6">
                                    <svg class="w-full h-full transform -rotate-90">
                                        <circle class="text-slate-100 dark:text-slate-800" cx="80" cy="80" fill="transparent" r="70" stroke="currentColor" stroke-width="12"></circle>
                                        <circle class="text-primary" cx="80" cy="80" fill="transparent" r="70" stroke="currentColor" stroke-dasharray="439.8" stroke-dashoffset="110" stroke-linecap="round" stroke-width="12"></circle>
                                    </svg>
                                    <div class="absolute inset-0 flex flex-col items-center justify-center">
                                        <span class="text-3xl font-bold">75%</span>
                                        <span class="text-[10px] text-slate-400 uppercase font-bold tracking-widest">Hoàn tất</span>
                                    </div>
                                </div>
                                <div class="w-full grid grid-cols-3 gap-2">
                                    <div class="text-center">
                                        <p class="text-xs text-slate-500">Duyệt</p>
                                        <p class="font-bold text-primary">106</p>
                                    </div>
                                    <div class="text-center border-x border-slate-100 dark:border-slate-800">
                                        <p class="text-xs text-slate-500">Chờ</p>
                                        <p class="font-bold">24</p>
                                    </div>
                                    <div class="text-center">
                                        <p class="text-xs text-slate-500">Từ chối</p>
                                        <p class="font-bold text-red-500">12</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <div class="group bg-white dark:bg-card-dark rounded-3xl border border-slate-200 dark:border-slate-800 shadow-sm hover:shadow-xl transition-all duration-500 overflow-hidden">
                        <div class="p-8">
                            <div class="flex justify-between items-start mb-10">
                                <div class="space-y-1">
                                    <h2 class="text-2xl font-bold tracking-tight">Quản lý người dùng</h2>
                                    <p class="text-slate-500 text-sm">Quản trị nhân sự, phòng ban và phân quyền hệ thống.</p>
                                </div>
                                <div class="p-4 bg-blue-50 dark:bg-blue-900/20 text-primary rounded-2xl group-hover:scale-110 transition-transform">
                                    <span class="material-symbols-outlined text-3xl">group</span>
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <a class="flex items-center p-4 rounded-2xl bg-slate-50 dark:bg-slate-800/50 hover:bg-primary hover:text-white transition-all group/item" href="#">
                                    <span class="material-symbols-outlined mr-4 p-2 bg-white dark:bg-slate-800 rounded-xl text-blue-600 group-hover/item:text-primary transition-colors">manage_accounts</span>
                                    <div>
                                        <p class="font-bold text-sm">Tài khoản</p>
                                        <p class="text-[10px] opacity-70">1,240 Active</p>
                                    </div>
                                </a>
                                <a class="flex items-center p-4 rounded-2xl bg-slate-50 dark:bg-slate-800/50 hover:bg-primary hover:text-white transition-all group/item" href="#">
                                    <span class="material-symbols-outlined mr-4 p-2 bg-white dark:bg-slate-800 rounded-xl text-indigo-600 group-hover/item:text-primary transition-colors">domain</span>
                                    <div>
                                        <p class="font-bold text-sm">Phòng ban</p>
                                        <p class="text-[10px] opacity-70">12 Departments</p>
                                    </div>
                                </a>
                                <a class="flex items-center p-4 rounded-2xl bg-slate-50 dark:bg-slate-800/50 hover:bg-primary hover:text-white transition-all group/item" href="#">
                                    <span class="material-symbols-outlined mr-4 p-2 bg-white dark:bg-slate-800 rounded-xl text-emerald-600 group-hover/item:text-primary transition-colors">badge</span>
                                    <div>
                                        <p class="font-bold text-sm">Nhân viên</p>
                                        <p class="text-[10px] opacity-70">HR Records</p>
                                    </div>
                                </a>
                                <a class="flex items-center p-4 rounded-2xl bg-slate-50 dark:bg-slate-800/50 hover:bg-primary hover:text-white transition-all group/item" href="#">
                                    <span class="material-symbols-outlined mr-4 p-2 bg-white dark:bg-slate-800 rounded-xl text-amber-600 group-hover/item:text-primary transition-colors">admin_panel_settings</span>
                                    <div>
                                        <p class="font-bold text-sm">Phân quyền</p>
                                        <p class="text-[10px] opacity-70">8 System Roles</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="px-8 py-4 bg-slate-50 dark:bg-slate-800/30 border-t border-slate-100 dark:border-slate-800 flex justify-between items-center">
                            <span class="text-xs text-slate-400">Cập nhật 5 phút trước</span>
                            <span class="material-symbols-outlined text-slate-400 group-hover:translate-x-1 transition-transform">arrow_forward</span>
                        </div>
                    </div>
                    <div class="group bg-white dark:bg-card-dark rounded-3xl border border-slate-200 dark:border-slate-800 shadow-sm hover:shadow-xl transition-all duration-500 overflow-hidden">
                        <div class="p-8">
                            <div class="flex justify-between items-start mb-10">
                                <div class="space-y-1">
                                    <h2 class="text-2xl font-bold tracking-tight">Tiêu chuẩn &amp; Đánh giá</h2>
                                    <p class="text-slate-500 text-sm">Theo dõi các cột mốc tiêu chuẩn và minh chứng đánh giá.</p>
                                </div>
                                <div class="p-4 bg-emerald-50 dark:bg-emerald-900/20 text-emerald-600 rounded-2xl group-hover:scale-110 transition-transform">
                                    <span class="material-symbols-outlined text-3xl">verified</span>
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <a class="flex items-center p-4 rounded-2xl bg-slate-50 dark:bg-slate-800/50 hover:bg-emerald-600 hover:text-white transition-all group/item" href="#">
                                    <span class="material-symbols-outlined mr-4 p-2 bg-white dark:bg-slate-800 rounded-xl text-emerald-600 group-hover/item:text-emerald-600 transition-colors">assignment</span>
                                    <div>
                                        <p class="font-bold text-sm">Tiêu chuẩn</p>
                                        <p class="text-[10px] opacity-70">Framework Setup</p>
                                    </div>
                                </a>
                                <a class="flex items-center p-4 rounded-2xl bg-slate-50 dark:bg-slate-800/50 hover:bg-emerald-600 hover:text-white transition-all group/item" href="#">
                                    <span class="material-symbols-outlined mr-4 p-2 bg-white dark:bg-slate-800 rounded-xl text-blue-600 group-hover/item:text-emerald-600 transition-colors">fact_check</span>
                                    <div>
                                        <p class="font-bold text-sm">Tiêu chí</p>
                                        <p class="text-[10px] opacity-70">Evaluation Rules</p>
                                    </div>
                                </a>
                                <a class="flex items-center p-4 rounded-2xl bg-slate-50 dark:bg-slate-800/50 hover:bg-emerald-600 hover:text-white transition-all group/item" href="#">
                                    <span class="material-symbols-outlined mr-4 p-2 bg-white dark:bg-slate-800 rounded-xl text-amber-600 group-hover/item:text-emerald-600 transition-colors">flag</span>
                                    <div>
                                        <p class="font-bold text-sm">Cột mốc</p>
                                        <p class="text-[10px] opacity-70">24 Milestones</p>
                                    </div>
                                </a>
                                <a class="flex items-center p-4 rounded-2xl bg-slate-50 dark:bg-slate-800/50 hover:bg-emerald-600 hover:text-white transition-all group/item" href="#">
                                    <span class="material-symbols-outlined mr-4 p-2 bg-white dark:bg-slate-800 rounded-xl text-purple-600 group-hover/item:text-emerald-600 transition-colors">inventory_2</span>
                                    <div>
                                        <p class="font-bold text-sm">Minh chứng</p>
                                        <p class="text-[10px] opacity-70">142 Files</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="px-8 py-4 bg-slate-50 dark:bg-slate-800/30 border-t border-slate-100 dark:border-slate-800 flex justify-between items-center">
                            <div class="flex items-center">
                                <div class="flex -space-x-2">
                                    <div class="w-6 h-6 rounded-full bg-emerald-500 border-2 border-white dark:border-slate-800"></div>
                                    <div class="w-6 h-6 rounded-full bg-blue-500 border-2 border-white dark:border-slate-800"></div>
                                    <div class="w-6 h-6 rounded-full bg-slate-300 border-2 border-white dark:border-slate-800 flex items-center justify-center text-[8px] font-bold">+5</div>
                                </div>
                                <span class="text-xs text-slate-400 ml-3">85% Hoàn thành tổng thể</span>
                            </div>
                            <span class="material-symbols-outlined text-slate-400 group-hover:translate-x-1 transition-transform">arrow_forward</span>
                        </div>
                    </div>
                </section>
                <section class="bg-white dark:bg-card-dark rounded-2xl shadow-sm border border-slate-200 dark:border-slate-800 overflow-hidden">
                    <div class="p-6 border-b border-slate-100 dark:border-slate-800 flex justify-between items-center">
                        <h2 class="font-bold text-lg">Hoạt động gần đây</h2>
                        <button class="text-primary text-sm font-semibold hover:underline">Xem tất cả</button>
                    </div>
                    <div class="divide-y divide-slate-100 dark:divide-slate-800">
                        <div class="p-6 flex items-center justify-between hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                            <div class="flex items-center space-x-4">
                                <div class="w-12 h-12 rounded-xl bg-blue-50 dark:bg-blue-900/20 flex items-center justify-center text-primary">
                                    <span class="material-symbols-outlined">person_add</span>
                                </div>
                                <div>
                                    <p class="text-sm font-bold">Nguyễn Văn A đã tham gia hệ thống</p>
                                    <p class="text-xs text-slate-500 mt-0.5">Phòng Đào tạo • Gán vai trò: Giảng viên</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <span class="text-xs font-medium text-slate-400">2 phút trước</span>
                            </div>
                        </div>
                        <div class="p-6 flex items-center justify-between hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                            <div class="flex items-center space-x-4">
                                <div class="w-12 h-12 rounded-xl bg-emerald-50 dark:bg-emerald-900/20 flex items-center justify-center text-emerald-600">
                                    <span class="material-symbols-outlined">upload_file</span>
                                </div>
                                <div>
                                    <p class="text-sm font-bold">Cập nhật minh chứng tiêu chuẩn 4.2</p>
                                    <p class="text-xs text-slate-500 mt-0.5">Trần Thị B • Tiêu chuẩn đào tạo nghề nghiệp</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <span class="text-xs font-medium text-slate-400">1 giờ trước</span>
                            </div>
                        </div>
                        <div class="p-6 flex items-center justify-between hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                            <div class="flex items-center space-x-4">
                                <div class="w-12 h-12 rounded-xl bg-amber-50 dark:bg-amber-900/20 flex items-center justify-center text-amber-600">
                                    <span class="material-symbols-outlined">warning</span>
                                </div>
                                <div>
                                    <p class="text-sm font-bold">Cảnh báo hệ thống: Lưu trữ sắp đầy</p>
                                    <p class="text-xs text-slate-500 mt-0.5">Dung lượng sử dụng đạt ngưỡng 92%</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <span class="text-xs font-medium text-slate-400">5 giờ trước</span>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </main>

</body>

</html>