<?php

namespace App\Modules\UserManagement\Infrastructure\Mappers;

use App\Modules\UserManagement\Application\DTOs\IndexUserViewDTO;
use App\Modules\UserManagement\Infrastructure\Models\User;

class IndexUserViewDTOMapper
{
    public static function fromModel(User $user)
    {
        return new IndexUserViewDTO(
            $user->first_name,
            $user->last_name,
            $user->email ?? '[Trống]',
            $user->role->name
        );
    }
}