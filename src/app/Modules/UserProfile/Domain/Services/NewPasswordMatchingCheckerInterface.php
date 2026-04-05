<?php

namespace App\Modules\UserProfile\Domain\Services;

interface NewPasswordMatchingCheckerInterface
{
    public function check(string $new_password, string $new_password_confirmation): void;
}