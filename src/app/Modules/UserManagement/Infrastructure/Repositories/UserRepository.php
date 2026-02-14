<?php

namespace App\Modules\UserManagement\Infrastructure\Repositories;

use App\Modules\UserManagement\Domain\Entities\User as EntitiesUser;
use App\Modules\UserManagement\Domain\Repositories\UserRepositoryInterface;
use App\Modules\UserManagement\Infrastructure\Mappers\UserMapper;
use App\Modules\UserManagement\Infrastructure\Models\User as ModelsUser;

class UserRepository implements UserRepositoryInterface
{
    public function create(EntitiesUser $entitiesUser): EntitiesUser
    {
        $modelsUser = ModelsUser::create([
            'id' => $entitiesUser->getUserId()->value(),
            'auth_id' => $entitiesUser->getAuthId()->value(),
            'first_name' => $entitiesUser->getFirstName(),
            'last_name' => $entitiesUser->getLastName(),
            'email' => $entitiesUser->getEmail() ? $entitiesUser->getEmail()->value() : null,
            'password' => $entitiesUser->getPassword()->value(),
            'role_id' => $entitiesUser->getRoleId()
        ]);
        return UserMapper::toDomain($modelsUser);
    }

    public function findOrFail(string $id): EntitiesUser
    {
        return UserMapper::toDomain(ModelsUser::findOrFail($id));
    }

    public function save(EntitiesUser $entitiesUser): void
    {
        $user_id = $entitiesUser->getUserId()->value();

        $modelsUser = ModelsUser::findOrFail($user_id);
        
        if ($entitiesUser->getEmail() !== null) {
            $modelsUser->email = $entitiesUser->getEmail()->value();
        }

        $modelsUser->first_name = $entitiesUser->getFirstName();
        $modelsUser->last_name = $entitiesUser->getLastName();
        $modelsUser->role_id = $entitiesUser->getRoleId();

        $modelsUser->save();
    }

    public function delete(string $id): void
    {
        $modelsUser = ModelsUser::findOrFail($id);

        $modelsUser->delete();
    }
}