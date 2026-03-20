<?php

namespace App\Modules\Authorization\Domain\Events;

final class RoleUpdated
{
    public function __construct(
        public readonly string $id,
        public readonly string $name,
        public readonly string $actor_id
    ) {}
}