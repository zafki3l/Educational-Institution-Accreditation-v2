<?php

namespace App\Modules\Authentication\Infrastructure\Mappers;

use App\Modules\Authentication\Domain\Entities\AuthenticableUser;
use App\Modules\Authentication\Domain\ValueObjects\AuthId;
use App\Modules\UserManagement\Domain\ValueObjects\Password;
use App\Modules\UserManagement\Domain\ValueObjects\UserId;
use App\Modules\UserManagement\Infrastructure\Models\User as ModelsUser;

class AuthenticableUserMapper
{
    public static function toDomain(ModelsUser $user): AuthenticableUser
    {
        return AuthenticableUser::create(
            UserId::fromString($user->id),
            AuthId::fromString($user->auth_id),
            Password::fromHash($user->password)
        );
    }
}