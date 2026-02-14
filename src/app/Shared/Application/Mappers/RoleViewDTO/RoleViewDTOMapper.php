<?php

namespace App\Shared\Application\Mappers\RoleViewDTO;

use App\Modules\Authorization\Infrastructure\Models\Role as ModelsRole;
use App\Shared\Application\DTOs\RoleView\RoleViewDTO;

class RoleViewDTOMapper
{
    public static function fromModel(ModelsRole $role)
    {
        return new RoleViewDTO(
            $role->id,
            $role->name
        );
    }
}