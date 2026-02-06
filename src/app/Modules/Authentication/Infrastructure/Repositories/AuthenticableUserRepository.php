<?php

namespace App\Modules\Authentication\Infrastructure\Repositories;

use App\Modules\Authentication\Domain\Entities\AuthenticableUser;
use App\Modules\Authentication\Domain\Repositories\AuthenticableUserRepositoryInterface;
use App\Modules\Authentication\Infrastructure\Mappers\AuthenticableUserMapper;
use App\Modules\UserManagement\Infrastructure\Models\User as ModelsUser;

class AuthenticableUserRepository implements AuthenticableUserRepositoryInterface
{
    public function findByAuthId(string $auth_id): ?AuthenticableUser
    {
        $modelsUser = ModelsUser::select(['id', 'auth_id', 'password'])
                    ->where('auth_id', $auth_id)
                    ->first();
        
        return $modelsUser 
            ? AuthenticableUserMapper::toDomain($modelsUser)
            : null;
    }

    public function findByUserId(string $user_id): ?AuthenticableUser
    {
        $modelsUser = ModelsUser::select(['id', 'auth_id', 'password'])
                    ->where('auth_id', $user_id)
                    ->first();

        return $modelsUser 
            ? AuthenticableUserMapper::toDomain($modelsUser)
            : null;
    }
}