<?php

namespace App\Modules\Authorization\Presentation\Controllers;

use App\Modules\Authorization\Application\UseCases\CreateRoleUseCase;
use App\Modules\Authorization\Presentation\Requests\CreateRoleRequest;

final class CreateRoleController extends RoleController
{
    public function __construct(private CreateRoleUseCase $createRoleUseCase) {}

    public function store(CreateRoleRequest $request): void
    {        
        $this->createRoleUseCase->execute($request);

        $this->redirect(ROOT_URL . '/roles');
    }
}