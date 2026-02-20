<?php

namespace App\Modules\DepartmentManagement\Infrastructure\Reader;

use App\Modules\DepartmentManagement\Infrastructure\Models\Department;
use App\Shared\Application\Contracts\DepartmentReader\DepartmentReaderInterface;
use App\Shared\Application\Mappers\DepartmentViewDTO\DepartmentViewDTOMapper;

class DepartmentReader implements DepartmentReaderInterface
{
    public function all(): array
    {
        return Department::all()
            ->map(fn ($department) => DepartmentViewDTOMapper::fromModel($department))
            ->toArray();
    }

    public function count(): int
    {
        return Department::count();
    }
} 
