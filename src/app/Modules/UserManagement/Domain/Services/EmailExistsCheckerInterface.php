<?php

namespace App\Modules\UserManagement\Domain\Services;

use App\Modules\UserManagement\Domain\ValueObjects\Email;

interface EmailExistsCheckerInterface
{
    public function isExists(Email $email): bool;
}