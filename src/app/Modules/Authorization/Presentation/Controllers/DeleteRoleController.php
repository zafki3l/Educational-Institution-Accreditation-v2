<?php

namespace App\Modules\Authorization\Presentation\Controllers;

use App\Modules\Authorization\Application\UseCases\DeleteRoleUseCase;

final class DeleteRoleController extends RoleController
{
    public function __construct(private DeleteRoleUseCase $deleteRoleUseCase) {}

    public function destroy(int $id): void
    {
        $this->deleteRoleUseCase->execute($id);

        $this->redirect(ROOT_URL . '/roles');
    }
}