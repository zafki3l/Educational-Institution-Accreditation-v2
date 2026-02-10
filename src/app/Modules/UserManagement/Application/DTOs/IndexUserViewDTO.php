<?php

namespace App\Modules\UserManagement\Application\DTOs;

class IndexUserViewDTO
{
    public function __construct(
        public readonly string $id,
        public readonly string $first_name,
        public readonly string $last_name,
        public readonly string $email,
        public readonly string $role_name
    ) {}
}