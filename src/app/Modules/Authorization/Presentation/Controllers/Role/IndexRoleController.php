<?php

namespace App\Modules\Authorization\Presentation\Controllers\Role;

use App\Shared\Application\Contracts\RoleReader\RoleReaderInterface;
use App\Shared\Response\ViewResponse;

final class IndexRoleController extends RoleController
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
                'title' => 'roles',
                'roles' => $roles
            ]
        );
    }
}