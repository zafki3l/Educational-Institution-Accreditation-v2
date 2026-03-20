<?php

namespace App\Modules\Authorization\Domain\Events;

final class RoleDeleted
{
    public function __construct(
        public readonly string $id,
        public readonly string $name,
        public readonly string $actor_id
    ) {}
}