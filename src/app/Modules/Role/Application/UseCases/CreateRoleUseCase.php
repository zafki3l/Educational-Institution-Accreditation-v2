<?php

namespace App\Modules\Role\Application\UseCases;

use App\Modules\Role\Application\Requests\CreateRoleRequestInterface;
use App\Modules\Role\Domain\Entities\Role;
use App\Modules\Role\Domain\Repositories\RoleRepositoryInterface;
use App\Shared\Infrastructure\MongoDBConnection;

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