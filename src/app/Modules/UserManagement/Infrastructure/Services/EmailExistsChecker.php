<?php

namespace App\Modules\UserManagement\Infrastructure\Services;

use App\Modules\UserManagement\Domain\Services\EmailExistsCheckerInterface;
use App\Modules\UserManagement\Domain\ValueObjects\Email;
use App\Modules\UserManagement\Infrastructure\Models\User;

final class EmailExistsChecker implements EmailExistsCheckerInterface
{
    public function isExists(Email $email): bool
    {
        return User::query()
                ->where('email', $email->value())
                ->exists();
    }
}