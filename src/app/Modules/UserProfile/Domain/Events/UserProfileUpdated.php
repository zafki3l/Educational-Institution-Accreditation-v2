<?php

namespace App\Modules\UserProfile\Domain\Events;

final class UserProfileUpdated
{
    public function __construct(
        public readonly string $actor_id,
        public readonly array $changes
    ) {}
}