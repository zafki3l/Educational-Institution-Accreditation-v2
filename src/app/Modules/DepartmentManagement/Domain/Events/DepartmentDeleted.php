<?php

namespace App\Modules\DepartmentManagement\Domain\Events;

final class DepartmentDeleted
{
    public function __construct(
        public readonly string $id,
        public readonly string $name,
        public readonly string $actor_id
    ) {}
}