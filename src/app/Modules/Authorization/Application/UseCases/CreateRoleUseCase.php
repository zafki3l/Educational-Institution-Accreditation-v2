<?php

namespace App\Modules\Authorization\Application\UseCases;

use App\Modules\Authorization\Application\Requests\CreateRoleRequestInterface;
use App\Modules\Authorization\Domain\Entities\Role;
use App\Modules\Authorization\Domain\Repositories\RoleRepositoryInterface;

final class CreateRoleUseCase
{
    public function __construct(private RoleRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function execute(CreateRoleRequestInterface $request): void
    {
        $role = Role::create($request->getName());

        $this->repository->create($role);
    }
}