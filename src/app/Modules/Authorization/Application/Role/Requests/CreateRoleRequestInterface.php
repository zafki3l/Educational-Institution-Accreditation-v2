<?php

namespace App\Modules\Authorization\Application\Role\Requests;

interface CreateRoleRequestInterface
{
    public function getName(): string;
}