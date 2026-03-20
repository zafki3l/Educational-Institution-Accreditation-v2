<?php

namespace App\Modules\Authorization\Presentation\Controllers;

use App\Modules\Authorization\Application\Readers\RoleReaderInterface;
use App\Modules\Authorization\Presentation\ViewModels\IndexRoleViewModel;
use App\Shared\Response\ViewResponse;

final class IndexRoleController extends AuthorizationController
{
    public function __construct(private RoleReaderInterface $roleReader) {}

    public function index(): ViewResponse
    {
        $roles = $this->roleReader->all();

        $indexRoleViewModels = array_map(
            fn ($roleReaderResponse) => new IndexRoleViewModel($roleReaderResponse->id, $roleReaderResponse->name), 
            $roles
        );

        return new ViewResponse(
            self::MODULE_NAME,
            'index', 
            'main.layouts', 
            [
                'title' => 'Cập nhật vai trò | ' . SYSTEM_NAME,
                'roles' => $indexRoleViewModels
            ]
        );
    }
}