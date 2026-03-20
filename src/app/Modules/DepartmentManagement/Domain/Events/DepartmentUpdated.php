<?php

namespace App\Modules\DepartmentManagement\Domain\Events;

final class DepartmentUpdated
{
    public function __construct(
        public readonly string $id,
        public readonly string $old_name,
        public readonly string $new_name,
        public readonly string $actor_id
    ) {}
}