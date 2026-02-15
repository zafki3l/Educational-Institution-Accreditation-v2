<?php

namespace App\Modules\DepartmentManagement\Domain\Entities;

use App\Modules\DepartmentManagement\Domain\Exception\EmptyDepartmentNameException;

class Department
{
    private function __construct(
        private string $id,
        private string $name
    ) {}

    public static function create(string $id, string $name): self
    {
        if (empty($name)) {
            throw new EmptyDepartmentNameException();
        }

        return new self($id, $name);
    }

    public function getId(): string { return $this->id; }

    public function getName(): string { return $this->name; }
}