<?php

namespace App\Modules\Authorization\Presentation\Controllers\Permission;

use App\Modules\Authorization\Application\Permission\UseCases\CreatePermissionUseCase;
use App\Modules\Authorization\Presentation\Controllers\AuthorizationController;
use App\Modules\Authorization\Presentation\Requests\Permission\CreatePermissionRequest;
use App\Shared\SessionManager\AuthSession;

final class CreatePermissionController extends AuthorizationController
{
    public function __construct(private CreatePermissionUseCase $createPermissionUseCase) {}

    public function store(CreatePermissionRequest $request)
    {
        $this->createPermissionUseCase->execute($request, AuthSession::getUserId());

        $this->redirect('/permissions');
    }
}