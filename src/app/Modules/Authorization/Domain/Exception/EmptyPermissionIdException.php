<?php

namespace App\Modules\Authorization\Domain\Exception;

use App\Shared\Exception\DomainException;

final class EmptyPermissionIdException extends DomainException
{
    public function __construct()
    {
        parent::__construct(
            "Không được bỏ trống permission id!",
            'PERMISSION_ID_EMPTY',
            404
        );
    }
}