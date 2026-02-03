<?php

namespace App\Modules\Role\Application\Requests;  

interface CreateRoleRequestInterface
{
    public function getName(): string;
}