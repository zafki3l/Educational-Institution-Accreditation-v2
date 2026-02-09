<!DOCTYPE html>
<html class="light" lang="vi">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>User Account Management Dashboard</title>
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
                    },
                    fontFamily: {
                        display: ["Inter", "sans-serif"],
                    },
                    borderRadius: {
                        DEFAULT: "0.5rem",
                    },
                },
            },
        };
    </script>
    <style type="text/tailwindcss">
        body { font-family: 'Inter', sans-serif; }
        .sidebar-item-active {
            @apply bg-blue-50 text-primary dark:bg-slate-800 dark:text-blue-400 border-r-4 border-primary font-semibold;
        }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
    </style>
</head>

<body class="bg-background-light dark:bg-background-dark text-slate-900 dark:text-slate-100 min-h-screen">
    <div class="flex">
        <aside class="w-64 fixed left-0 top-[65px] h-[calc(100vh-65px)] bg-white dark:bg-slate-900 border-r border-slate-200 dark:border-slate-800 hidden md:block">
            <nav class="mt-6">
                <div class="px-4 mb-4">
                    <p class="text-[10px] uppercase font-bold text-slate-400 dark:text-slate-500 tracking-wider">Quản lý người dùng</p>
                </div>
                <a class="sidebar-item-active flex items-center px-6 py-3 gap-3 text-sm" href="#">
                    Quản lý tài khoản người dùng
                </a>
                <a class="flex items-center px-6 py-3 gap-3 text-sm font-medium text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800 hover:text-primary transition-colors" href="#">
                    Quản lý phòng ban
                </a>
                <a class="flex items-center px-6 py-3 gap-3 text-sm font-medium text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800 hover:text-primary transition-colors" href="#">
                    Quản lý nhân viên
                </a>
                <a class="flex items-center px-6 py-3 gap-3 text-sm font-medium text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800 hover:text-primary transition-colors" href="#">
                    Cập nhật quyền
                </a>
            </nav>
        </aside>
        <main class="flex-1 md:ml-64 p-8">
            <div class="max-w-7xl mx-auto">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
                    <div>
                        <h1 class="text-2xl font-bold text-slate-900 dark:text-white uppercase tracking-tight">Quản lý tài khoản người dùng</h1>
                    </div>
                    <button class="bg-primary hover:bg-blue-700 text-white px-4 py-2.5 rounded-lg flex items-center justify-center gap-2 font-medium transition-all shadow-sm hover:shadow-md active:scale-95">
                        <span class="material-symbols-outlined text-lg">person_add</span>
                        THÊM NGƯỜI DÙNG MỚI
                    </button>
                </div>
                <div class="bg-white dark:bg-slate-900 p-4 rounded-xl border border-slate-200 dark:border-slate-800 mb-6 flex flex-wrap items-center gap-4">
                    <div class="flex-1 min-w-[240px] relative">
                        <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400">search</span>
                        <input class="w-full pl-10 pr-4 py-2 bg-slate-50 dark:bg-slate-800 border-transparent focus:ring-2 focus:ring-primary rounded-lg text-sm transition-all" placeholder="Tìm kiếm người dùng..." type="text" />
                    </div>
                    <select class="bg-slate-50 dark:bg-slate-800 border-transparent focus:ring-2 focus:ring-primary rounded-lg text-sm px-4 py-2 min-w-[150px]">
                        <option>Tất cả vai trò</option>
                        <option>Admin</option>
                        <option>Staff</option>
                    </select>
                </div>
                <div class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead class="bg-slate-50 dark:bg-slate-800/50 border-b border-slate-200 dark:border-slate-800">
                                <tr>
                                    <th class="px-6 py-4 text-xs font-bold text-slate-500 dark:text-slate-400 uppercase">Họ và tên</th>
                                    <th class="px-6 py-4 text-xs font-bold text-slate-500 dark:text-slate-400 uppercase">Email</th>
                                    <th class="px-6 py-4 text-xs font-bold text-slate-500 dark:text-slate-400 uppercase">Vai trò</th>
                                    <th class="px-6 py-4 text-xs font-bold text-slate-500 dark:text-slate-400 uppercase text-right">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-200 dark:divide-slate-800">
                                <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/30 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <span class="font-semibold text-sm">Nguyễn Văn A</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-slate-600 dark:text-slate-400">nguyenvana@fbu.edu.vn</td>
                                    <td class="px-6 py-4">
                                        <span class="px-2 py-1 bg-purple-100 text-purple-700 dark:bg-purple-900/30 dark:text-purple-400 text-[10px] font-bold rounded uppercase">Admin</span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex items-center justify-end gap-2">
                                            <button class="p-1.5 text-slate-500 hover:text-primary hover:bg-blue-50 dark:hover:bg-slate-800 rounded-md transition-colors" title="Sửa">
                                                <span class="material-symbols-outlined text-lg">edit</span>
                                            </button>
                                            <button class="p-1.5 text-slate-500 hover:text-red-500 hover:bg-red-50 dark:hover:bg-slate-800 rounded-md transition-colors" title="Xóa">
                                                <span class="material-symbols-outlined text-lg">delete</span>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/30 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <span class="font-semibold text-sm">Trần Thị H</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-slate-600 dark:text-slate-400">tranthih@fbu.edu.vn</td>
                                    <td class="px-6 py-4">
                                        <span class="px-2 py-1 bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400 text-[10px] font-bold rounded uppercase">Staff</span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex items-center justify-end gap-2">
                                            <button class="p-1.5 text-slate-500 hover:text-primary hover:bg-blue-50 dark:hover:bg-slate-800 rounded-md transition-colors">
                                                <span class="material-symbols-outlined text-lg">edit</span>
                                            </button>
                                            <button class="p-1.5 text-slate-500 hover:text-red-500 hover:bg-red-50 dark:hover:bg-slate-800 rounded-md transition-colors">
                                                <span class="material-symbols-outlined text-lg">delete</span>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/30 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <span class="font-semibold text-sm">Lê Minh M</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-slate-600 dark:text-slate-400">leminhm@fbu.edu.vn</td>
                                    <td class="px-6 py-4">
                                        <span class="px-2 py-1 bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400 text-[10px] font-bold rounded uppercase">Staff</span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex items-center justify-end gap-2">
                                            <button class="p-1.5 text-slate-500 hover:text-primary hover:bg-blue-50 dark:hover:bg-slate-800 rounded-md transition-colors">
                                                <span class="material-symbols-outlined text-lg">edit</span>
                                            </button>
                                            <button class="p-1.5 text-slate-500 hover:text-red-500 hover:bg-red-50 dark:hover:bg-slate-800 rounded-md transition-colors">
                                                <span class="material-symbols-outlined text-lg">delete</span>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/30 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <span class="font-semibold text-sm">Phạm Quốc Q</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-slate-600 dark:text-slate-400">phamquocq@fbu.edu.vn</td>
                                    <td class="px-6 py-4">
                                        <span class="px-2 py-1 bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400 text-[10px] font-bold rounded uppercase">Staff</span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex items-center justify-end gap-2">
                                            <button class="p-1.5 text-slate-500 hover:text-primary hover:bg-blue-50 dark:hover:bg-slate-800 rounded-md transition-colors">
                                                <span class="material-symbols-outlined text-lg">edit</span>
                                            </button>
                                            <button class="p-1.5 text-slate-500 hover:text-red-500 hover:bg-red-50 dark:hover:bg-slate-800 rounded-md transition-colors">
                                                <span class="material-symbols-outlined text-lg">delete</span>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="bg-slate-50 dark:bg-slate-800/50 border-t border-slate-200 dark:border-slate-800 px-6 py-4 flex items-center justify-between">
                        <span class="text-sm text-slate-500 dark:text-slate-400">Hiển thị 1 - 4 của 12 người dùng</span>
                        <div class="flex gap-2">
                            <button class="p-2 border border-slate-200 dark:border-slate-700 rounded-lg hover:bg-white dark:hover:bg-slate-700 disabled:opacity-50 transition-all" disabled="">
                                <span class="material-symbols-outlined text-lg">chevron_left</span>
                            </button>
                            <button class="p-2 border border-slate-200 dark:border-slate-700 rounded-lg hover:bg-white dark:hover:bg-slate-700 transition-all">
                                <span class="material-symbols-outlined text-lg">chevron_right</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <div class="md:hidden fixed bottom-0 left-0 right-0 bg-white dark:bg-slate-900 border-t border-slate-200 dark:border-slate-800 flex justify-around p-3">
        <button class="flex flex-col items-center gap-1 text-primary">
            <span class="material-symbols-outlined">manage_accounts</span>
            <span class="text-[10px] font-bold">Người dùng</span>
        </button>
        <button class="flex flex-col items-center gap-1 text-slate-400">
            <span class="material-symbols-outlined">corporate_fare</span>
            <span class="text-[10px]">Phòng ban</span>
        </button>
        <button class="flex flex-col items-center gap-1 text-slate-400">
            <span class="material-symbols-outlined">badge</span>
            <span class="text-[10px]">Nhân viên</span>
        </button>
        <button class="flex flex-col items-center gap-1 text-slate-400">
            <span class="material-symbols-outlined">settings</span>
            <span class="text-[10px]">Cài đặt</span>
        </button>
    </div>

</body>

</html>