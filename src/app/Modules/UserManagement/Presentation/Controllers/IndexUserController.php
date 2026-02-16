<?php

namespace App\Modules\UserManagement\Presentation\Controllers;

use App\Modules\UserManagement\Infrastructure\Readers\UserReader;
use App\Modules\UserManagement\Presentation\Requests\IndexUserRequest;
use App\Shared\Application\Contracts\DepartmentReader\DepartmentReaderInterface;
use App\Shared\Application\Contracts\RoleReader\RoleReaderInterface;
use App\Shared\Response\ViewResponse;

final class IndexUserController extends UserController
{
    public function __construct(
        private UserReader $userReader,
        private RoleReaderInterface $roleReader,
        private DepartmentReaderInterface $departmentReader
    ) {}

    public function index(IndexUserRequest $request): ViewResponse
    {
        $results = $this->userReader->all($request->getKeyword(), $request->getRoleId());
        $roles = $this->roleReader->all();
        $departments = $this->departmentReader->all();

        return new ViewResponse(
            self::MODULE_NAME, 
            'index/main', 
            'main.layouts',
            [
                'title' => 'Quản lý người dùng | ' . SYSTEM_NAME,
                'users' => $results->items,
                'pagination' => $results,
                'roles' => $roles,
                'departments' => $departments
            ]
        );
    }
}