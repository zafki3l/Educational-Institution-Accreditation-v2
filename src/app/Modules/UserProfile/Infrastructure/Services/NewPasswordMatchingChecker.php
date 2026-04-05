<?php

namespace App\Modules\UserProfile\Infrastructure\Services;

use App\Modules\UserProfile\Domain\Exceptions\NewPasswordNotMatchingException;
use App\Modules\UserProfile\Domain\Services\NewPasswordMatchingCheckerInterface;

final class NewPasswordMatchingChecker implements NewPasswordMatchingCheckerInterface
{
    public function check(string $new_password, string $new_password_confirmation): void
    {
        if ($new_password !== $new_password_confirmation) {
            throw new NewPasswordNotMatchingException();
        }
    }
}