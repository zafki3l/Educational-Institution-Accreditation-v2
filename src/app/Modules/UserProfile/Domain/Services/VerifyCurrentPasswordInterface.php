<?php

namespace App\Modules\UserProfile\Domain\Services;

interface VerifyCurrentPasswordInterface
{
    public function verify(string $from_request, string $from_db): void;
}