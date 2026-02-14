<?php

namespace App\Modules\Authorization\Infrastructure\Readers;

use App\Modules\Authorization\Infrastructure\Models\Role;
use App\Shared\Application\Contracts\RoleReader\RoleReaderInterface;
use App\Shared\Application\Mappers\RoleViewDTO\RoleViewDTOMapper;

final class RoleReader implements RoleReaderInterface
{
    public function all(): array
    {
        return Role::all()
            ->map(fn ($role) => RoleViewDTOMapper::fromModel($role))
            ->toArray();
    }
}