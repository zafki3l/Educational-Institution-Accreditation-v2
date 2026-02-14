<?php

namespace App\Modules\Authorization\Domain\Exception;

use App\Shared\Exception\DomainException;

final class EmptyPermissionNameException extends DomainException
{
    public function __construct()
    {
        parent::__construct(
            "Không được bỏ trống permission name!",
            'PERMISSION_NAME_EMPTY',
            404
        );
    }
}