<?php

namespace App\Modules\Authorization\Application\Readers;

interface RoleReaderInterface
{
    public function all(): array;

    public function count(): int;
}