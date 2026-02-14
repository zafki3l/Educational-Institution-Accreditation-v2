<?php

namespace App\Modules\Authorization\Infrastructure\Repositories;

use App\Modules\Authorization\Domain\Entities\Permission as EntitiesPermission;
use App\Modules\Authorization\Domain\Repositories\PermissionRepositoryInterface;
use App\Modules\Authorization\Infrastructure\Mappers\PermissionMapper;
use App\Modules\Authorization\Infrastructure\Models\Permission as ModelsPermission;

class PermissionRepository implements PermissionRepositoryInterface
{
    public function create(EntitiesPermission $entitiesPermission)
    {
        ModelsPermission::create([
            'id' => $entitiesPermission->getId(),
            'name' => $entitiesPermission->getName()
        ]);
    }

    public function findOrFail(string $id): EntitiesPermission
    {
        $modelsPermission = ModelsPermission::findOrFail($id);

        return PermissionMapper::toDomain($modelsPermission);
    }

    public function delete(EntitiesPermission $entitiesPermission): void
    {
        ModelsPermission::where('id', $entitiesPermission->getId())->delete();
    }
}