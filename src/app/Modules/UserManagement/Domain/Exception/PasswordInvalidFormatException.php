<?php

namespace App\Modules\UserManagement\Domain\Exception;

use App\Shared\Exception\DomainException;

final class PasswordInvalidFormatException extends DomainException
{
    public function __construct()
    {
        parent::__construct('Mật khẩu phải gồm chữ và số!', "PASSWORD_INVALID_FORMAT");
    }
}