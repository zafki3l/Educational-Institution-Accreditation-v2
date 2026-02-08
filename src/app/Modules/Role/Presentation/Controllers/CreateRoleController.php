<?php

namespace App\Modules\Role\Presentation\Controllers;

use App\Modules\Role\Application\UseCases\CreateRoleUseCase;
use App\Modules\Role\Presentation\Requests\CreateRoleRequest;

final class CreateRoleController extends RoleController
{
    public function __construct(private CreateRoleUseCase $createRoleUseCase) {}

    public function store(CreateRoleRequest $request): void
    {        
        $this->createRoleUseCase->execute($request);

        $this->redirect(ROOT_URL . '/roles');
    }
}