<?php

namespace App\Modules\Authorization\Presentation\Controllers\Role;

use App\Modules\Authorization\Presentation\Controllers\AuthorizationController;
use App\Shared\Application\Contracts\RoleReader\RoleReaderInterface;
use App\Shared\Response\ViewResponse;

final class IndexRoleController extends AuthorizationController
{
    public function __construct(private RoleReaderInterface $roleReader) {}

    public function index(): ViewResponse
    {
        $roles = $this->roleReader->all();

        return new ViewResponse(
            self::MODULE_NAME,
            'role/index', 
            'main.layouts', 
            [
                'title' => 'Cập nhật vai trò | ' . SYSTEM_NAME,
                'roles' => $roles
            ]
        );
    }

    public function assign()
    {
        return new ViewResponse(
            self::MODULE_NAME,
            'assign-permission/index',
            'main.layouts'
        );
    }
}