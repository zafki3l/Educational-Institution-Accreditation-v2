<?php

namespace App\Modules\Authorization\Application\Permission\Requests;

interface CreatePermissionRequestInterface
{
    public function getId(): string;
    public function getName(): string;
}