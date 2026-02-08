<?php

namespace App\Modules\Role\Infrastructure\Mappers;

use App\Modules\Role\Domain\Entities\Role as EntitiesRole;
use App\Modules\Role\Infrastructure\Models\Role as ModelsRole;

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