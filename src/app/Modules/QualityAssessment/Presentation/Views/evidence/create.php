<!DOCTYPE html>
<html class="light" lang="vi">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography"></script>
    <link rel="stylesheet" href="/css/sidebar.css">
    <link rel="stylesheet" href="/css/index/index.css">
    <link rel="stylesheet" href="/css/index/createUser.css">
    <link rel="stylesheet" href="/css/pagination.css">
    <link rel="stylesheet" href="/css/criteria/table.css">
    <link rel="stylesheet" href="/css/evidence/index.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet" />
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        primary: "#1e40af", // Deep Blue
                        "background-light": "#f8fafc",
                        "background-dark": "#0f172a",
                        "surface-light": "#ffffff",
                        "surface-dark": "#1e293b",
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
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .sidebar-item-active {
            background-color: rgba(30, 64, 175, 0.1);
            color: #1e40af;
            border-right: 4px solid #1e40af;
        }
    </style>
</head>

<body class="bg-background-light dark:bg-background-dark text-slate-900 dark:text-slate-100 min-h-screen">
    <div class="layout">
        <?php include dirname(__DIR__, 5) . '/Shared/Views/layouts/quality-assessment/sidebar.php' ?>

        <main class="flex-1 p-6 md:p-10 overflow-y-auto">
            <div class="max-w-4xl mx-auto">
                <div class="mb-8">
                    <h2 class="text-2xl font-bold text-slate-800 dark:text-white mb-2">Thêm mới minh chứng</h2>
                    <p class="text-slate-500 dark:text-slate-400">Vui lòng nhập đầy đủ thông tin minh chứng theo các tiêu chuẩn quy định.</p>
                </div>
                <div class="bg-surface-light dark:bg-surface-dark rounded-xl shadow-xl border border-slate-200 dark:border-slate-700 overflow-hidden">
                    <form action="#" class="p-8 space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300" for="ma-mc">Mã minh chứng <span class="text-red-500">*</span></label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                                        <span class="material-icons-round text-lg">qr_code</span>
                                    </span>
                                    <input class="block w-full pl-10 pr-3 py-2.5 bg-white dark:bg-slate-800 border border-slate-300 dark:border-slate-600 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-all text-sm dark:placeholder-slate-500" id="ma-mc" placeholder="Nhập mã minh chứng" type="text" />
                                </div>
                            </div>
                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300" for="ten-mc">Tên minh chứng <span class="text-red-500">*</span></label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                                        <span class="material-icons-round text-lg">description</span>
                                    </span>
                                    <input class="block w-full pl-10 pr-3 py-2.5 bg-white dark:bg-slate-800 border border-slate-300 dark:border-slate-600 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-all text-sm dark:placeholder-slate-500" id="ten-mc" placeholder="Nhập tên minh chứng" type="text" />
                                </div>
                            </div>
                        </div>
                        <div class="space-y-6">
                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300" for="tieu-chuan">Tiêu chuẩn</label>
                                <select class="block w-full px-3 py-2.5 bg-white dark:bg-slate-800 border border-slate-300 dark:border-slate-600 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-all text-sm appearance-none" id="tieu-chuan">
                                    <option value="">Chọn tiêu chuẩn</option>
                                    <option selected="" value="2">Tiêu chuẩn 2: Quản trị</option>
                                    <option value="1">Tiêu chuẩn 1: Tầm nhìn, Sứ mạng</option>
                                </select>
                            </div>
                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300" for="tieu-chi">Tiêu chí</label>
                                <select class="block w-full px-3 py-2.5 bg-white dark:bg-slate-800 border border-slate-300 dark:border-slate-600 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-all text-sm appearance-none" id="tieu-chi">
                                    <option value="">Chọn tiêu chí</option>
                                    <option selected="" value="2.1">Tiêu chí 2.1: Hệ thống quản trị (bao gồm hội đồng quản trị hoặc hội đồng trường; các tổ chức đảng, đoàn thể; các hội đồng tư vấn...)</option>
                                </select>
                            </div>
                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300" for="chi-bao">Chỉ báo</label>
                                <select class="block w-full px-3 py-2.5 bg-white dark:bg-slate-800 border border-slate-300 dark:border-slate-600 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-all text-sm appearance-none" id="chi-bao">
                                    <option value="">Chọn chỉ báo</option>
                                    <option selected="" value="1">1 - CSGD có thành lập hội đồng quản trị/hội đồng trường; có các tổ chức đảng, đoàn thể, các hội đồng tư vấn theo quy định...</option>
                                </select>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4 border-t border-slate-100 dark:border-slate-700">
                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300" for="quyet-dinh">Số/Ký hiệu/Quyết định</label>
                                <input class="block w-full px-3 py-2.5 bg-white dark:bg-slate-800 border border-slate-300 dark:border-slate-600 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-all text-sm" id="quyet-dinh" placeholder="Nhập số hiệu quyết định" type="text" />
                            </div>
                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300" for="ngay-ban-hanh">Ngày ban hành</label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none text-slate-400">
                                        <span class="material-icons-round text-lg">calendar_today</span>
                                    </span>
                                    <input class="block w-full px-3 py-2.5 bg-white dark:bg-slate-800 border border-slate-300 dark:border-slate-600 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-all text-sm" id="ngay-ban-hanh" type="date" />
                                </div>
                            </div>
                            <div class="space-y-2 md:col-span-2">
                                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300" for="noi-phat-hanh">Nơi phát hành/Cơ quan ban hành</label>
                                <input class="block w-full px-3 py-2.5 bg-white dark:bg-slate-800 border border-slate-300 dark:border-slate-600 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-all text-sm" id="noi-phat-hanh" placeholder="Nhập nơi phát hành" type="text" />
                            </div>
                        </div>
                        <div class="space-y-2 pt-4">
                            <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300">Đính kèm minh chứng</label>
                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-slate-300 dark:border-slate-600 border-dashed rounded-lg hover:border-primary dark:hover:border-blue-500 transition-colors cursor-pointer bg-slate-50 dark:bg-slate-800/50 group">
                                <div class="space-y-1 text-center">
                                    <span class="material-icons-round text-4xl text-slate-400 group-hover:text-primary transition-colors">cloud_upload</span>
                                    <div class="flex text-sm text-slate-600 dark:text-slate-400">
                                        <label class="relative cursor-pointer bg-transparent rounded-md font-semibold text-primary hover:text-blue-700 focus-within:outline-none" for="file-upload">
                                            <span>Tải tệp lên</span>
                                            <input class="sr-only" id="file-upload" name="file-upload" type="file" />
                                        </label>
                                        <p class="pl-1">hoặc kéo và thả tệp vào đây</p>
                                    </div>
                                    <p class="text-xs text-slate-500">PDF, PNG, JPG hoặc DOCX tối đa 10MB</p>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center justify-end gap-4 pt-6 mt-6 border-t border-slate-100 dark:border-slate-700">
                            <button class="px-6 py-2.5 text-sm font-semibold text-slate-600 dark:text-slate-400 hover:text-slate-800 dark:hover:text-slate-200 transition-colors" type="button">Hủy bỏ</button>
                            <button class="px-10 py-2.5 bg-primary hover:bg-blue-700 text-white text-sm font-bold rounded-lg shadow-lg shadow-blue-500/30 transition-all flex items-center gap-2" type="submit">
                                <span class="material-icons-round text-base">save</span>
                                Tạo minh chứng
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</body>

</html>