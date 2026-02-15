<?php

namespace App\Modules\DepartmentManagement\Infrastructure\Mappers;

use App\Modules\DepartmentManagement\Domain\Entities\Department as EntitiesDepartment;
use App\Modules\DepartmentManagement\Infrastructure\Models\Department as ModelsDepartment;

final class DepartmentMapper
{
    public static function toDomain(ModelsDepartment $modelsDepartment): EntitiesDepartment
    {
        $entitiesDepartment = EntitiesDepartment::create(
            $modelsDepartment->id,
            $modelsDepartment->name
        );

        return $entitiesDepartment;
    }

    public static function toModel(EntitiesDepartment $entitiesDepartment): ModelsDepartment
    {
        $modelsDepartment = new ModelsDepartment();

        $modelsDepartment->id = $entitiesDepartment->getId();
        $modelsDepartment->name = $entitiesDepartment->getName();

        return $modelsDepartment;
    }
}