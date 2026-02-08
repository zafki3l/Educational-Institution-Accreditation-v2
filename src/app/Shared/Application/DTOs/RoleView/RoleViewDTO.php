<?php

namespace App\Shared\Application\DTOs\RoleView;

class RoleViewDTO
{
    public function __construct(
        public readonly int $id, 
        public readonly string $name
    ) {}
}