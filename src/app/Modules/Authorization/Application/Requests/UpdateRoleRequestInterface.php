<?php

namespace App\Modules\Authorization\Application\Requests;

interface UpdateRoleRequestInterface
{
    public function getId(): int;

    public function getName(): string;
}
