<?php

namespace App\Modules\UserProfile\Domain\Services;

interface EmailExistsCheckerInterface
{
    public function check(string $email): void;
}