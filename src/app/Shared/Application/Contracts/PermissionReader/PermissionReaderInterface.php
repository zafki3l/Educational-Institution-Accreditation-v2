<?php

namespace App\Shared\Application\Contracts\PermissionReader;

interface PermissionReaderInterface
{
    public function all(): array;
}