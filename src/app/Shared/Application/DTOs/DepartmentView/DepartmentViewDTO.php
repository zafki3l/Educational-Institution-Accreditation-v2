<?php

namespace App\Shared\Application\DTOs\DepartmentView;

class DepartmentViewDTO
{
    public function __construct(
        public readonly string $id, 
        public readonly string $name
    ) {}
}