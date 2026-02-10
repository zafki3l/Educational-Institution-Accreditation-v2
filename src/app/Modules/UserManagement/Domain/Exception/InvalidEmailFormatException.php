<?php

namespace App\Modules\UserManagement\Domain\Exception;

use App\Shared\Exception\DomainException;

class InvalidEmailFormatException extends DomainException
{
    public function __construct()
    {
        parent::__construct(
            "Invalid email format",
            "INVALID_EMAIL_FORMAT",
        );
    }
}