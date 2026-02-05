<?php

namespace App\Modules\Role\Domain\Entities;

class Role
{
    private int $id;
    private string $name;

    public function getId(): int {return $this->id;}

	public function getName(): string {return $this->name;}

    public function setId(int $id): self {$this->id = $id; return $this;}

	public function setName(string $name): self {$this->name = $name; return $this;}

    public function isAdmin(): bool
    {
        return strtolower($this->name) === 'admin';
    }

    public function isStaff(): bool
    {
        if (self::isAdmin()) {
            return true;
        } else if (strtolower($this->name) === 'staff') {
            return true;
        } else {
            return false;
        }
    }
}