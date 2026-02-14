<?php

namespace App\Modules\Authorization\Presentation\Controllers\Role;

use App\Modules\Authorization\Application\UseCases\DeleteRoleUseCase;
use App\Shared\SessionManager\AuthSession;

final class DeleteRoleController extends RoleController
{
    public function __construct(private DeleteRoleUseCase $deleteRoleUseCase) {}

    public function destroy(int $id): void
    {
        $this->deleteRoleUseCase->execute($id, AuthSession::getUserId());

        $this->redirect(ROOT_URL . '/roles');
    }
}