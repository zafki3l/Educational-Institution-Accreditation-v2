<?php

namespace App\Modules\Authorization\Presentation\Controllers\Permission;

use App\Modules\Authorization\Infrastructure\Models\Permission;
use App\Modules\Authorization\Presentation\Controllers\AuthorizationController;
use App\Shared\Response\ViewResponse;

final class IndexPermissionController extends AuthorizationController
{
    public function index(): ViewResponse
    {
        $permissions = Permission::all();

        return new ViewResponse(
            self::MODULE_NAME,
            'permission/index',
            'main.layouts',
            [
                'title' => 'Cập nhật quyền | ' . SYSTEM_NAME,
                'permissions' => $permissions
            ]
        );
    }
}