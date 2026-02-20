<?php

namespace App\Modules\Authorization\Infrastructure\Mappers;

use App\Modules\Authorization\Domain\Entities\Permission as EntitiesPermission;
use App\Modules\Authorization\Infrastructure\Models\Permission as ModelsPermission;

final class PermissionMapper
{
    public static function toDomain(ModelsPermission $modelsPermission): EntitiesPermission
    {
        $entitiesPermission = EntitiesPermission::create(
            $modelsPermission->id,
            $modelsPermission->name
        );

        return $entitiesPermission;
    }

    public static function toModel(EntitiesPermission $entitiesPermission): ModelsPermission
    {
        $modelsPermission = new ModelsPermission();

        $modelsPermission->id = $entitiesPermission->getId();
        $modelsPermission->name = $entitiesPermission->getName();

        return $modelsPermission;
    }
}