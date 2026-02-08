<?php

namespace App\Modules\UserManagement\Domain\Repositories;

use App\Modules\UserManagement\Domain\Entities\User as EntitiesUser;

interface UserRepositoryInterface
{
    public function create(EntitiesUser $entitiesUser): void;
}