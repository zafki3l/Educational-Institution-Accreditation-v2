<?php

namespace App\Shared\Mappers\RoleView;

use App\Modules\Role\Infrastructure\Models\Role as ModelsRole;
use App\Shared\DTOs\RoleView\RoleViewDTO;

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