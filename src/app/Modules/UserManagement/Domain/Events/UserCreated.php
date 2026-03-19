<?php

namespace App\Modules\UserManagement\Domain\Events;

use App\Modules\UserManagement\Domain\Entities\User;

final class UserCreated
{
    public function __construct(
        public readonly User $user,
        public readonly string $actor_id
    ) {}
}