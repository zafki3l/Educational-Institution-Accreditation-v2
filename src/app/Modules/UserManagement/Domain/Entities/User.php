<?php

namespace App\Modules\UserManagement\Domain\Entities;

use App\Modules\Authentication\Domain\ValueObjects\AuthId;
use App\Modules\Role\Domain\Entities\Role;
use App\Modules\UserManagement\Domain\Exception\RoleMissingException;
use App\Modules\UserManagement\Domain\Exception\UserNameEmptyException as ExceptionUserNameEmptyException;
use App\Modules\UserManagement\Domain\ValueObjects\Email;
use App\Modules\UserManagement\Domain\ValueObjects\Password;
use App\Modules\UserManagement\Domain\ValueObjects\UserId;
use PHPUnit\Framework\Constraint\IsEmpty;
use UserNameEmptyException;

class User
{
    private function __construct(
        private UserId $id,
        private AuthId $auth_id,
        private string $first_name,
        private string $last_name,
        private ?Email $email,
        private Password $password,
        private int $role_id
    ) {}

    public static function create(
        UserId $id,
        AuthId $auth_id,
        string $first_name,
        string $last_name,
        ?Email $email,
        Password $password,
        int $role_id
    ): self {
        self::IsEmptyName($first_name, $last_name);

        return new self($id, $auth_id, $first_name, $last_name, $email, $password, $role_id);
    }

    public function update(
        string $first_name,
        string $last_name,
        ?string $email,
        int $role_id
    ) {
        if ($email !== null) {
            $this->assignEmail(Email::fromString($email));
        }

        self::IsEmptyName($first_name, $last_name);
        $this->changeFirstName($first_name);
        $this->changeLastName($last_name);

        $this->changeRole($role_id);
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

    public function getEmail(): ?Email
    {
        return $this->email;
    }

    public function getPassword(): Password
    {
        return $this->password;
    }

    public function getRoleId(): int
    {
        return $this->role_id;
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

    public function assignEmail(Email $email): void
    {
        $this->email = $email;
    }

    public function changePassword(Password $password): void
    {
        $this->password = $password;
    }

    public function changeRole(int $role_id): void
    {
        self::IsEmptyRoleId($role_id);

        $this->role_id = $role_id;
    }

    private static function IsEmptyRoleId(int $role_id): void
    {
        if (empty($role_id)) {
            throw new RoleMissingException();
        }
    }

    private static function IsEmptyName(string $first_name, string $last_name): void
    {
        if (empty($first_name) || empty($last_name)) {
            throw new ExceptionUserNameEmptyException();
        }
    }
}
