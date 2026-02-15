<?php

namespace App\Modules\DepartmentManagement\Infrastructure\Repositories;

use App\Modules\DepartmentManagement\Domain\Entities\Department as EntitiesDepartment;
use App\Modules\DepartmentManagement\Domain\Repositories\DepartmentRepositoryInterface;
use App\Modules\DepartmentManagement\Infrastructure\Models\Department as ModelsDepartment;

class DepartmentRepository implements DepartmentRepositoryInterface
{
    public function create(EntitiesDepartment $entitiesDepartment): void
    {
        ModelsDepartment::create([
            'id' => $entitiesDepartment->getId(),
            'name' => $entitiesDepartment->getName()
        ]);
    }

    public function findOrFail(string $id): EntitiesDepartment
    {
        throw new \Exception('Not implemented');
    }

    public function delete(EntitiesDepartment $entitiesPermission): void
    {
        throw new \Exception('Not implemented');
    }
}