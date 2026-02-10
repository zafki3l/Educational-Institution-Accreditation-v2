<?php

namespace App\Modules\UserManagement\Infrastructure\Mappers;

use App\Modules\UserManagement\Application\DTOs\EditUserViewDTO;
use App\Modules\UserManagement\Infrastructure\Models\User;

class EditUserViewDTOMapper
{
    public static function fromModel(User $user)
    {
        return new EditUserViewDTO(
            $user->id,
            $user->first_name,
            $user->last_name,
            $user->email ?? '',
            $user->role_id
        );
    }
}