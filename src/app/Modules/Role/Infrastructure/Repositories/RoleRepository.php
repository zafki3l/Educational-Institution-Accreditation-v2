<?php

namespace App\Modules\Role\Infrastructure\Repositories;

use App\Modules\Role\Domain\Entities\Role as EntitiesRole;
use App\Modules\Role\Domain\Entities\RoleCollection;
use App\Modules\Role\Domain\Repositories\RoleRepositoryInterface;
use App\Modules\Role\Infrastructure\Mappers\RoleCollectionMapper;
use App\Modules\Role\Infrastructure\Mappers\RoleMapper;
use App\Modules\Role\Infrastructure\Models\Role as ModelsRole;
use App\Shared\Contracts\RoleReaderInterface;
use App\Shared\DTOs\RoleView\RoleViewDTO;
use App\Shared\Mappers\RoleView\RoleViewDTOMapper;

class RoleRepository implements RoleRepositoryInterface, RoleReaderInterface
{
    public function findAll(): RoleCollection
    {
        $modelsRole = ModelsRole::all();

        return RoleCollectionMapper::toDomain($modelsRole);
    }

    public function readAll(): array
    {
        return ModelsRole::all()
            ->map(fn ($role) => RoleViewDTOMapper::fromModel($role))
            ->toArray();
    }

    public function findOrFail(int $id): EntitiesRole
    {
        $modelsRole = ModelsRole::findOrFail($id);

        return RoleMapper::toDomain($modelsRole);
    }

    public function create(EntitiesRole $entitiesRole): void
    {
        ModelsRole::create(['name' => $entitiesRole->getName()]);   
    }

    public function delete(EntitiesRole $role): void
    {
        ModelsRole::where('id', $role->getId())->delete();
    }
}