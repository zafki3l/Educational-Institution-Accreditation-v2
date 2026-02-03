<?php

namespace App\Modules\Role\Application\UseCases;

use App\Modules\Role\Domain\Repositories\RoleRepositoryInterface;

class DeleteRoleUseCase
{
    public function __construct(private RoleRepositoryInterface $repository) {}

    public function execute(int $id)
    {
        $role = $this->repository->findOrFail($id);

        $this->repository->delete($role);
    }
}