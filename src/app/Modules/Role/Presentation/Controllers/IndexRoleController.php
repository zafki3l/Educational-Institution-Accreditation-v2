<?php

namespace App\Modules\Role\Presentation\Controllers;

use App\Modules\Role\Infrastructure\Readers\RoleReader;
use App\Shared\Response\ViewResponse;

final class IndexRoleController extends RoleController
{
    public function __construct(private RoleReader $roleReader) {}

    public function index(): ViewResponse
    {
        $roles = $this->roleReader->all();

        return new ViewResponse(
            self::MODULE_NAME,
            'index', 
            'main.layouts', 
            [
                'title' => 'roles',
                'roles' => $roles
            ]
        );
    }
}