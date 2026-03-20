<?php

namespace App\Modules\Authentication\Domain\Events;

final class UserLoginFailed
{
    public function __construct(public readonly string $identifier) {}
}
