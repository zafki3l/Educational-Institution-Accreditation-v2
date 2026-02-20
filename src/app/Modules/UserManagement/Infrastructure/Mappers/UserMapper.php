<?php

namespace App\Modules\UserManagement\Infrastructure\Mappers;

use App\Modules\Authentication\Domain\ValueObjects\AuthId;
use App\Modules\UserManagement\Domain\Entities\User as EntitesUser;
use App\Modules\UserManagement\Domain\ValueObjects\Email;
use App\Modules\UserManagement\Domain\ValueObjects\Password;
use App\Modules\UserManagement\Domain\ValueObjects\UserId;
use App\Modules\UserManagement\Infrastructure\Models\User as ModelsUser;

class UserMapper
{
    public static function toDomain(ModelsUser $modelsUser): EntitesUser
    {
        return EntitesUser::create(
            UserId::fromString($modelsUser->id),
            AuthId::fromString($modelsUser->auth_id),
            $modelsUser->first_name,
            $modelsUser->last_name,
            $modelsUser->email ? Email::fromString($modelsUser->email) : null,
            Password::fromHash($modelsUser->password),
            $modelsUser->role_id,
            $modelsUser->department_id
        );
    }
}