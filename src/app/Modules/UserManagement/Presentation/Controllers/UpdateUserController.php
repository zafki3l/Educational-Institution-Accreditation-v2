<?php

namespace App\Modules\UserManagement\Presentation\Controllers;

use App\Shared\Response\ViewResponse;

final class UpdateUserController extends UserController
{
    public function edit(): ViewResponse
    {
        return new ViewResponse(
            self::MODULE_NAME,
            'update/main',
            'main.layouts',
            [
                'title' => 'Cập nhật người dùng | ' . SYSTEM_NAME
            ]
        );
    }
}