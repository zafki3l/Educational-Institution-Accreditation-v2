<?php

namespace App\Modules\Authorization\Domain\Repositories;

use App\Modules\Authorization\Domain\Entities\Permission as EntitiesPermission;

interface PermissionRepositoryInterface
{
    public function create(EntitiesPermission $entitiesPermission);

    public function findOrFail(string $id): EntitiesPermission;

    public function delete(EntitiesPermission $entitiesPermission): void;
}