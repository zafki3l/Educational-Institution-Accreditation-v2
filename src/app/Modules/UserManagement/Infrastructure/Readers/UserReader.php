<?php

namespace App\Modules\UserManagement\Infrastructure\Readers;

use App\Modules\UserManagement\Application\DTOs\EditUserViewDTO;
use App\Modules\UserManagement\Infrastructure\Mappers\EditUserViewDTOMapper;
use App\Modules\UserManagement\Infrastructure\Mappers\IndexUserViewDTOMapper;
use App\Modules\UserManagement\Infrastructure\Models\User;
use App\Shared\Application\Contracts\UserReader\UserReaderInterface;

class UserReader implements UserReaderInterface
{
    public function all(): array
    {
        return User::query()
            ->with('role:id,name')
            ->orderByDesc('created_at')
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

    public function findById(string $id): EditUserViewDTO
    {
        $user = User::query()
                ->select(
                    'id', 
                    'first_name', 
                    'last_name', 
                    'email', 
                    'role_id'
                )
                ->where('id', $id)
                ->first();

        return EditUserViewDTOMapper::fromModel($user);
    }

    public function count(): int
    {
        return User::count();
    }
}
