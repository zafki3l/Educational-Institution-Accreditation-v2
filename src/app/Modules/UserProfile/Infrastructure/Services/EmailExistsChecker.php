<?php

namespace App\Modules\UserProfile\Infrastructure\Services;

use App\Modules\UserManagement\Infrastructure\Models\User;
use App\Modules\UserProfile\Domain\Exceptions\EmailExistException;
use App\Modules\UserProfile\Domain\Services\EmailExistsCheckerInterface;

final class EmailExistsChecker implements EmailExistsCheckerInterface
{
    public function check(string $email): void
    {
        if (User::query()->where('email', $email)->exists()) {
            throw new EmailExistException();
        }
    }
}