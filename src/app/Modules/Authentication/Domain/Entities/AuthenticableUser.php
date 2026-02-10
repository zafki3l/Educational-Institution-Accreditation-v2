<?php

namespace App\Modules\Authentication\Domain\Entities;

use App\Modules\Authentication\Domain\ValueObjects\AuthId;
use App\Modules\UserManagement\Domain\ValueObjects\Password;
use App\Modules\UserManagement\Domain\ValueObjects\UserId;

class AuthenticableUser
{
    private function __construct(
        private UserId $user_id,
        private AuthId $auth_id,
        private Password $password,
        private int $role_id
    ) {}

    public static function create(
        UserId $user_id,
        AuthId $auth_id,
        Password $password,
        int $role_id
    ): self {
        return new self(
            $user_id,
            $auth_id,
            $password,
            $role_id
        );
    }

    public function getUserId(): UserId
    {
        return $this->user_id;
    }

    public function getAuthId(): AuthId
    {
        return $this->auth_id;
    }

    public function getPassword(): Password
    {
        return $this->password;
    }

    public function getRoleId(): int
    {
        return $this->role_id;
    }

    public function verify(string $plain): bool
    {
        return $this->password->verify($plain);
    }
}