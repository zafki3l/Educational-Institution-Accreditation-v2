<?php

namespace App\Modules\Authorization\Domain\Events;

final class RoleCreated
{
    public function __construct(
        public readonly string $name,
        public readonly string $actor_id
    ) {}
}