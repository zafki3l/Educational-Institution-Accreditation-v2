<?php

namespace App\Modules\DepartmentManagement\Domain\Repositories;

use App\Modules\DepartmentManagement\Domain\Entities\Department as EntitiesDepartment;

interface DepartmentRepositoryInterface
{
    public function create(EntitiesDepartment $entitiesDepartment): void;

    public function findOrFail(string $id): EntitiesDepartment;

    public function delete(EntitiesDepartment $entitiesPermission): void;
}