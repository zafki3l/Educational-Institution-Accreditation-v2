<?php

namespace App\Modules\UserManagement\Presentation\Controllers;

use App\Shared\Contracts\RoleReaderInterface;
use App\Shared\Http\Traits\HttpResponse;
use App\Shared\Response\ViewResponse;

class UserController
{
    use HttpResponse;

    private const MODULE_NAME = 'UserManagement';

    public function __construct(private RoleReaderInterface $role_reader)
    {
    }

    public function index(): ViewResponse
    {
        return new ViewResponse(
            self::MODULE_NAME, 
            'user-list/main', 
            'main.layouts',
            [
                'title' => 'Quản lý người dùng | ' . SYSTEM_NAME
            ]
        );
    }

    public function create()
    {
        $roles = $this->role_reader->readAll();
        return new ViewResponse(
            self::MODULE_NAME, 
            'create/main', 
            'main.layouts',
            [
                'title' => 'Thêm người dùng | ' . SYSTEM_NAME,
                'roles' => $roles
            ]
        );
    }
}