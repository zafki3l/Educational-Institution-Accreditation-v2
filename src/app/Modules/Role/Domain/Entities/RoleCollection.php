<?php

namespace App\Modules\Role\Domain\Entities;

use ArrayIterator;
use IteratorAggregate;
use Traversable;

class RoleCollection implements IteratorAggregate
{
    private array $roles;

    public function __construct(array $roles)
    {
        $this->roles = $roles;
    }

    public function all(): array
    {
        return $this->roles;
    }

    public function first(): ?Role
    {
        return $this->roles[0] ?? null;
    }

    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->roles);
    }
}
