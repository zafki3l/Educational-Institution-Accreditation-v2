<?php

namespace App\Modules\Role\Application\UseCases;

use App\Modules\Role\Application\Requests\CreateRoleRequestInterface;
use App\Modules\Role\Domain\Entities\Role;
use App\Modules\Role\Domain\Repositories\RoleRepositoryInterface;

class CreateRoleUseCase
{
    public function __construct(private RoleRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function execute(CreateRoleRequestInterface $request): void
    {
        $this->repository->create($this->buildEntity($request));
    }

    private function buildEntity(CreateRoleRequestInterface $request): Role
    {
        $role = new Role();

        $role->setName($request->getName());

        return $role;
    }
}