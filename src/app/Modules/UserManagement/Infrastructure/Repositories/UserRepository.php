<?php

namespace App\Modules\UserManagement\Infrastructure\Repositories;

use App\Modules\UserManagement\Domain\Entities\User as EntitiesUser;
use App\Modules\UserManagement\Domain\Repositories\UserRepositoryInterface;
use App\Modules\UserManagement\Infrastructure\Models\User as ModelsUser;

class UserRepository implements UserRepositoryInterface
{
    public function create(EntitiesUser $entitiesUser): void
    {
        ModelsUser::create([
            'id' => $entitiesUser->getUserId()->value(),
            'auth_id' => $entitiesUser->getAuthId()->value(),
            'first_name' => $entitiesUser->getFirstName(),
            'last_name' => $entitiesUser->getLastName(),
            'email' => $entitiesUser->getEmail()->value(),
            'password' => $entitiesUser->getPassword()->value(),
            'role_id' => $entitiesUser->getRoleId()
        ]);
    }
}