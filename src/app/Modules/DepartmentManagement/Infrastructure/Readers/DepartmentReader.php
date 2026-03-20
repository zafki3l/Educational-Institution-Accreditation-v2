<?php

namespace App\Modules\DepartmentManagement\Infrastructure\Readers;

use App\Modules\DepartmentManagement\Application\Readers\DepartmentReaderInterface;
use App\Modules\DepartmentManagement\Application\Responses\DepartmentReaderResponse;
use App\Modules\DepartmentManagement\Infrastructure\Models\Department;

class DepartmentReader implements DepartmentReaderInterface
{
    public function all(): array
    {
        return Department::all()
            ->map(fn ($department) => new DepartmentReaderResponse($department->id, $department->name))
            ->toArray();
    }

    public function count(): int
    {
        return Department::count();
    }
} 
