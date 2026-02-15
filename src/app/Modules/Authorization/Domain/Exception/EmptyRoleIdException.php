<?php

namespace App\Modules\Authorization\Domain\Exception;

use App\Shared\Exception\DomainException;

final class EmptyRoleIdException extends DomainException
{
    public function __construct()
    {
        parent::__construct(
            "Không được bỏ trống role id!",
            'ROLE_ID_EMPTY',
            404
        );
    }
}