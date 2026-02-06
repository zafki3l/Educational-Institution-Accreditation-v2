<?php

namespace App\Modules\UserManagement\Domain\Entities;

use App\Modules\Authentication\Domain\ValueObjects\AuthId;
use App\Modules\Role\Domain\Entities\Role;
use App\Modules\UserManagement\Domain\ValueObjects\Email;
use App\Modules\UserManagement\Domain\ValueObjects\Password;
use App\Modules\UserManagement\Domain\ValueObjects\UserId;

class User
{
    private function __construct(
        private UserId $id,
        private AuthId $auth_id,
        private string $first_name,
        private string $last_name,
        private Email $email,
        private Password $password,
        private Role $role
    ) {}

    public static function create(
        UserId $id,
        AuthId $auth_id,
        string $first_name,
        string $last_name,
        Email $email,
        Password $password,
        Role $role
    ): self {
        return new self($id, $auth_id, $first_name, $last_name, $email, $password, $role);
    }

    public function getUserId(): UserId
    {
        return $this->id;
    }

    public function getAuthId(): AuthId
    {
        return $this->auth_id;
    }

    public function getFirstName(): string
    {
        return $this->first_name;
    }

    public function getLastName(): string
    {
        return $this->last_name;
    }

    public function getFullName(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function getEmail(): Email
    {
        return $this->email;
    }

    public function getPassword(): Password
    {
        return $this->password;
    }

    public function getRole(): Role
    {
        return $this->role;
    }

    public function changeAuthId(AuthId $auth_id): void
    {
        $this->auth_id = $auth_id;
    }

    public function changeFirstName(string $first_name): void
    {
        $this->first_name = $first_name;
    }

    public function changeLastName(string $last_name): void
    {
        $this->last_name = $last_name;
    }

    public function changeEmail(Email $email): void
    {
        $this->email = $email;
    }

    public function changePassword(Password $password): void
    {
        $this->password = $password;
    }

    public function changeRole(Role $role): void
    {
        $this->role = $role;
    }

    public function isAdmin(): bool
    {
        return $this->role->isAdmin();
    }

    public function isStaff(): bool
    {
        return $this->role->isStaff();
    }
}
