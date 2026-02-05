<?php

namespace App\Shared\Contracts;

interface RoleReaderInterface
{
    public function readAll(): array;
}