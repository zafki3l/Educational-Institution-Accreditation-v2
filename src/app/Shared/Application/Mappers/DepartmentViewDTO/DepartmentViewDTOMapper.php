<?php

namespace App\Shared\Application\Mappers\DepartmentViewDTO;

use App\Modules\DepartmentManagement\Infrastructure\Models\Department;
use App\Shared\Application\DTOs\DepartmentView\DepartmentViewDTO;

class DepartmentViewDTOMapper
{
    public static function fromModel(Department $department)
    {
        return new DepartmentViewDTO(
            $department->id,
            $department->name
        );
    }
}