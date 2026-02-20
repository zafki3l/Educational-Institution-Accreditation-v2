<?php

namespace App\Shared\Application\Contracts\DepartmentReader;

interface DepartmentReaderInterface
{
    public function all(): array;

    public function count(): int;
}