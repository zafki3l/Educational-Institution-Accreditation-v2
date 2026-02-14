<?php

namespace App\Modules\Authorization\Presentation\Controllers\Permission;

use App\Modules\Authorization\Application\Permission\UseCases\DeletePermissionUseCase;
use App\Modules\Authorization\Infrastructure\Models\Permission;
use App\Modules\Authorization\Presentation\Controllers\AuthorizationController;
use App\Shared\SessionManager\AuthSession;

final class DeletePermissionController extends AuthorizationController
{
    public function __construct(private DeletePermissionUseCase $deletePermissionUseCase) {}

    public function destroy(string $id)
    {
        $this->deletePermissionUseCase->execute($id, AuthSession::getUserId());

        $this->redirect('/permissions');
    }
}