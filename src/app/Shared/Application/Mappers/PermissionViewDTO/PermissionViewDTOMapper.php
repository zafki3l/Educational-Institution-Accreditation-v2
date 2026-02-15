<?php

namespace App\Shared\Application\Mappers\PermissionViewDTO;

use App\Modules\Authorization\Infrastructure\Models\Permission as ModelsPermission;
use App\Shared\Application\DTOs\PermissionView\PermissionViewDTO;

class PermissionViewDTOMapper
{
    public static function fromModel(ModelsPermission $permission)
    {
        return new PermissionViewDTO(
            $permission->id,
            $permission->name
        );
    }
}