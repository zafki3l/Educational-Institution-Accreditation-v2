<?php

namespace App\Modules\Authentication\Application\Responses;

final class LoginResponse
{
    public function __construct(
        public readonly string $user_id,
        public readonly string $identifier,
        public readonly int $role_id
    ) {}
}