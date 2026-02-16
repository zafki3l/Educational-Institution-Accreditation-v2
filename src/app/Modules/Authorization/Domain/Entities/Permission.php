<?php

namespace App\Modules\Authorization\Domain\Entities;

use App\Modules\Authorization\Domain\Exception\EmptyPermissionIdException;
use App\Modules\Authorization\Domain\Exception\EmptyPermissionNameException;

class Permission
{
    private function __construct(
        private string $id,
        private string $name
    ) {}

    public static function create(string $id, string $name): self
    {
        if (empty($id)) {
            throw new EmptyPermissionIdException();
        }

        if (empty($name)) {
            throw new EmptyPermissionNameException();
        }

        return new self($id, $name);
    }

    public function getId(): string { return $this->id; }

    public function getName(): string { return $this->name; }
}