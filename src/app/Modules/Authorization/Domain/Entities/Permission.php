<?php

namespace App\Modules\Authorization\Domain\Entities;

use App\Modules\Authorization\Domain\Exception\EmptyRoleNameException;

class Permission
{
    private function __construct(
        private string $id,
        private string $name
    ) {
        $this->id = $id;
    }

    public static function create(string $id, string $name): self
    {
        if (empty($name)) {
            throw new EmptyRoleNameException();
        }

        return new self($id, $name);
    }

    public function getId(): string { return $this->id; }

    public function getName(): string { return $this->name; }
}