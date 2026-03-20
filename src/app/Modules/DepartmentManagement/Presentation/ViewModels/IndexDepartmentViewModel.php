<?php

namespace App\Modules\DepartmentManagement\Presentation\ViewModels;
final class IndexDepartmentViewModel
{
    public function __construct(
        public readonly string $id, 
        public readonly string $name
    ) {}
}