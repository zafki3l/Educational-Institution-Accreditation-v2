<?php

namespace App\Modules\Role\Domain\Exception;

use App\Shared\Exception\DomainException;

class InvalidRoleName extends DomainException
{
    public function __construct(string $name)
    {
        parent::__construct(
            "{$name} is not a valid role name",
            'ROLE_NAME_INVALID',
            404
        );

        $this->setMeta(['name' => $name]);
    }
}