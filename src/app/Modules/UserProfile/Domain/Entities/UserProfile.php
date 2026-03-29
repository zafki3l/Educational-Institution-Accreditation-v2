<?php

namespace App\Modules\UserProfile\Domain\Entities;

use App\Modules\UserProfile\Domain\Exceptions\UserIdEmptyException;
use App\Modules\UserProfile\Domain\Exceptions\UserNameEmptyException;

class UserProfile
{
    private array $changes = [];

    private function __construct(
        private string $id,
        private string $first_name,
        private string $last_name,
        private string $email,
        private ?string $password
    ) {}

    public static function create(
        string $id,
        string $first_name,
        string $last_name,
        string $email,
    ): self {
        if ($id === '') {
            throw new UserIdEmptyException();
        }

        if ($first_name === '' && $last_name === '') {
            throw new UserNameEmptyException();
        }

        return new self($id, $first_name, $last_name, $email, null);
    }

    public static function fromPersistent(
        string $id,
        string $first_name,
        string $last_name,
        string $email,
        ?string $password
    ) {
        return new self($id, $first_name, $last_name, $email, $password);
    }

    public function update(string $first_name, string $last_name, string $email): void
    {
        if ($this->first_name !== $first_name) {
            $this->changes['first_name'] = [
                'old' => $this->first_name,
                'new' => $first_name
            ];

            $this->first_name = $first_name;
        }

        if ($this->last_name !== $last_name) {
            $this->changes['last_name'] = [
                'old' => $this->last_name,
                'new' => $last_name
            ];

            $this->last_name = $last_name;
        }

        if ($this->email !== $email) {
            $this->changes['email'] = [
                'old' => $this->email,
                'new' => $email
            ];

            $this->email = $email;
        }
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getFirstName(): string
    {
        return $this->first_name;
    }

    public function getLastName(): string
    {
        return $this->last_name;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function changePassword(string $password): void
    {
        $this->password = $password;
    }

    public function getChanges(): array
    {
        return $this->changes;
    }

    public function hasChanges(): bool
    {
        return !empty($this->changes);
    }
}
