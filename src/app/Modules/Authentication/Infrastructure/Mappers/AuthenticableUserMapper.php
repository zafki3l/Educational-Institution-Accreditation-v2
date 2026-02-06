<?php

namespace App\Modules\Authentication\Infrastructure\Mappers;

use App\Modules\Authentication\Domain\Entities\AuthenticableUser;
use App\Modules\UserManagement\Infrastructure\Models\User as ModelsUser;

class AuthenticableUserMapper
{
    public static function toDomain(ModelsUser $user): AuthenticableUser
    {
        return AuthenticableUser::create(
            $user->id,
            $user->auth_id,
            $user->password
        );
    }
}