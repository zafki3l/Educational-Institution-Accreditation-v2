<?php

namespace App\Shared\Application\Contracts\RoleReader;

interface RoleReaderInterface
{
    public function all(): array;

    public function count(): int;
}