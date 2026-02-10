<?php

namespace App\Modules\UserManagement\Presentation\Controllers;

use App\Modules\UserManagement\Infrastructure\Readers\UserReader;
use App\Shared\Application\Contracts\RoleReader\RoleReaderInterface;
use App\Shared\Response\ViewResponse;

final class IndexUserController extends UserController
{
    public function __construct(
        private UserReader $userReader,
        private RoleReaderInterface $roleReader
    ) {}

    public function index(): ViewResponse
    {
        $users = $this->userReader->all();
        $roles = $this->roleReader->all();

        return new ViewResponse(
            self::MODULE_NAME, 
            'index/main', 
            'main.layouts',
            [
                'title' => 'Quản lý người dùng | ' . SYSTEM_NAME,
                'users' => $users,
                'roles' => $roles
            ]
        );
    }
}