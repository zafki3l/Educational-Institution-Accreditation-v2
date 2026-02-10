<?php

namespace App\Modules\Dashboard\Presentation\Controllers;

use App\Shared\Application\Contracts\UserReader\UserReaderInterface;
use App\Shared\Response\ViewResponse;

final class AdminDashboardController extends DashboardController
{
    public function __construct(private UserReaderInterface $userReader) {}

    public function dashboard(): ViewResponse
    {
        $total_users = $this->userReader->count();

        return new ViewResponse(
            self::MODULE_NAME,
            'admin-dashboard/main',
            'main.layouts',
            [
                'title' => 'Trang điều khiển admin | ' . SYSTEM_NAME,
                'total_users' => $total_users
            ]
        );
    }
}