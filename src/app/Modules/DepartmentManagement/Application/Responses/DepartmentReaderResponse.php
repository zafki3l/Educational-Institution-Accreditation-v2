<?php

namespace App\Modules\DepartmentManagement\Application\Responses;

final class DepartmentReaderResponse
{
    public function __construct(
        public readonly string $id, 
        public readonly string $name
    ) {}
}