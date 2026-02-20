<?php

namespace App\Modules\Authorization\Infrastructure\Readers;

use App\Modules\Authorization\Infrastructure\Models\Permission;
use App\Shared\Application\Contracts\PermissionReader\PermissionReaderInterface;
use App\Shared\Application\Mappers\PermissionViewDTO\PermissionViewDTOMapper;

final class PermissionReader implements PermissionReaderInterface
{
    public function all(): array
    {
        return Permission::all()
            ->map(fn ($permssion) => PermissionViewDTOMapper::fromModel($permssion))
            ->toArray();
    }
}