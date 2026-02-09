<?php

namespace App\Modules\UserManagement\Presentation\Controllers;

use App\Shared\Response\ViewResponse;

final class IndexUserController extends UserController
{
    public function index(): ViewResponse
    {
        return new ViewResponse(
            self::MODULE_NAME, 
            'index/main', 
            'main.layouts',
            [
                'title' => 'Quản lý người dùng | ' . SYSTEM_NAME
            ]
        );
    }
}