<?php

namespace App\Modules\Role\Domain\Repositories;

use App\Modules\Role\Domain\Entities\Role as EntitiesRole;

interface RoleRepositoryInterface
{
    public function findOrFail(int $id): EntitiesRole;

    public function create(EntitiesRole $role): void;

    public function delete(EntitiesRole $role): void;
}