<?php

namespace App\Modules\Role\Application\UseCases;

use App\Modules\Role\Domain\Entities\RoleCollection;
use App\Modules\Role\Domain\Repositories\RoleRepositoryInterface;

class FindAllRoleUseCase
{
    public function __construct(private RoleRepositoryInterface $repository) {}

    public function execute(): RoleCollection
    {   
        return $this->repository->findAll();
    }
}