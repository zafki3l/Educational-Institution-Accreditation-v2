<?php

namespace App\Modules\UserManagement\Infrastructure\Readers;

use App\Modules\UserManagement\Infrastructure\Mappers\IndexUserViewDTOMapper;
use App\Modules\UserManagement\Infrastructure\Models\User;

class UserReader
{
    public function all(): array
    {
        return User::query()
            ->with('role:id,name')
            ->get([
                'id',
                'first_name',
                'last_name',
                'email',
                'role_id'
            ])
            ->map(function (User $user) {
                return IndexUserViewDTOMapper::fromModel($user);
            })
            ->toArray();
    }
}
