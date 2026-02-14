<?php

namespace App\Modules\Authorization\Infrastructure\Mappers;

use App\Modules\Authorization\Domain\Entities\Role as EntitiesRole;
use App\Modules\Authorization\Infrastructure\Models\Role as ModelsRole;

final class RoleMapper
{
    public static function toDomain(ModelsRole $modelsRole): EntitiesRole
    {
        $entitiesRole = EntitiesRole::create(
            $modelsRole->name
        );

        $entitiesRole->assignId($modelsRole->id);

        return $entitiesRole;
    }

    public static function toModel(EntitiesRole $entitiesRole): ModelsRole
    {
        $modelsRole = new ModelsRole();

        $modelsRole->id = $entitiesRole->getId();
        $modelsRole->name = $entitiesRole->getName();

        return $modelsRole;
    }
}