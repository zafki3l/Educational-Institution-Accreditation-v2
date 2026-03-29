<?php

namespace App\Modules\UserProfile\Infrastructure\Services;

use App\Modules\UserManagement\Domain\ValueObjects\Password;
use App\Modules\UserProfile\Domain\Exceptions\PasswordIncorrectException;
use App\Modules\UserProfile\Domain\Services\VerifyCurrentPasswordInterface;

final class VerifyCurrentPassword implements VerifyCurrentPasswordInterface
{
    public function verify(string $from_request, string $from_db): void
    {
        $current_password = Password::fromHash($from_db);

        if (!$current_password->verify($from_request)) {
            throw new PasswordIncorrectException();
        }
    }
}