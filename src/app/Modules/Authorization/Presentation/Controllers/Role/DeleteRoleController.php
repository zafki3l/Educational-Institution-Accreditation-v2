<?php

namespace App\Modules\Authorization\Presentation\Controllers\Role;

use App\Modules\Authorization\Application\Role\UseCases\DeleteRoleUseCase;
use App\Modules\Authorization\Presentation\Controllers\AuthorizationController;
use App\Shared\SessionManager\AuthSession;

final class DeleteRoleController extends AuthorizationController
{
    public function __construct(private DeleteRoleUseCase $deleteRoleUseCase) {}

    public function destroy(int $id): void
    {
        $this->deleteRoleUseCase->execute($id, AuthSession::getUserId());

        $this->redirect(ROOT_URL . '/roles');
    }
}