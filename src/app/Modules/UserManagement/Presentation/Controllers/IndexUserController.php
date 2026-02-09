<?php

namespace App\Modules\UserManagement\Presentation\Controllers;

use App\Modules\UserManagement\Infrastructure\Readers\UserReader;
use App\Shared\Response\ViewResponse;

final class IndexUserController extends UserController
{
    public function __construct(private UserReader $userReader) {}
    public function index(): ViewResponse
    {
        $users = $this->userReader->all();
        
        return new ViewResponse(
            self::MODULE_NAME, 
            'index/main', 
            'main.layouts',
            [
                'title' => 'Quản lý người dùng | ' . SYSTEM_NAME,
                'users' => $users
            ]
        );
    }
}