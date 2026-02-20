<?php

namespace App\Modules\Authorization\Presentation\Controllers\Permission;

use App\Modules\Authorization\Presentation\Controllers\AuthorizationController;
use App\Shared\Application\Contracts\PermissionReader\PermissionReaderInterface;
use App\Shared\Response\ViewResponse;

final class IndexPermissionController extends AuthorizationController
{
    public function __construct(private PermissionReaderInterface $permissionReader) {}

    public function index(): ViewResponse
    {
        $permissions = $this->permissionReader->all();

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