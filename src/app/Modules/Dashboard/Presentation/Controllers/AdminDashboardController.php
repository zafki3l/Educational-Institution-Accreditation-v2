<?php

namespace App\Modules\Dashboard\Presentation\Controllers;

use App\Shared\Response\ViewResponse;

final class AdminDashboardController extends DashboardController
{
    public function dashboard(): ViewResponse
    {
        return new ViewResponse(
            self::MODULE_NAME,
            'admin-dashboard/main',
            'main.layouts',
            [
                'title' => 'Trang điều khiển admin | ' . SYSTEM_NAME
            ]
        );
    }
}