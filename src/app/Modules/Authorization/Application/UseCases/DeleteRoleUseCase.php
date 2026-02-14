<?php

namespace App\Modules\Authorization\Application\UseCases;

use App\Modules\Authorization\Domain\Repositories\RoleRepositoryInterface;

final class DeleteRoleUseCase
{
    public function __construct(private RoleRepositoryInterface $repository) {}

    public function execute(int $id)
    {
        $role = $this->repository->findOrFail($id);

        $this->repository->delete($role);
    }
}