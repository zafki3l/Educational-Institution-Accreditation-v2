<?php

namespace App\Modules\Role\Domain\Repositories;

use App\Modules\Role\Domain\Entities\Role as EntitiesRole;
use App\Modules\Role\Domain\Entities\RoleCollection;

interface RoleRepositoryInterface
{
    public function findAll(): RoleCollection;

    public function findOrFail(int $id): EntitiesRole;

    public function create(EntitiesRole $role): void;

    public function delete(EntitiesRole $role): void;
}