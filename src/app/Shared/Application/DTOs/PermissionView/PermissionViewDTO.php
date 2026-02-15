<?php

namespace App\Shared\Application\DTOs\PermissionView;

class PermissionViewDTO
{
    public function __construct(
        public readonly string $id, 
        public readonly string $name
    ) {}
}