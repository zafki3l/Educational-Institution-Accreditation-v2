<?php

namespace App\Modules\Authorization\Application\Requests;  

interface CreateRoleRequestInterface
{
    public function getName(): string;
}