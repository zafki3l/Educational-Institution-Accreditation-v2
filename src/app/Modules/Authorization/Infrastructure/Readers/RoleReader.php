<?php

namespace App\Modules\Authorization\Infrastructure\Readers;

use App\Modules\Authorization\Application\Readers\RoleReaderInterface;
use App\Modules\Authorization\Application\Responses\RoleReaderResponse;
use App\Modules\Authorization\Infrastructure\Models\Role;

final class RoleReader implements RoleReaderInterface
{
    public function all(): array
    {
        return Role::all()
                ->map(fn ($role) => new RoleReaderResponse($role->id, $role->name))
                ->toArray();
    }

    public function count(): int
    {
        return Role::count();
    }
}