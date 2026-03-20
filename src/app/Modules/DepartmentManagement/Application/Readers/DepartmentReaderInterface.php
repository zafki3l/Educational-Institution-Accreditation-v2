<?php

namespace App\Modules\DepartmentManagement\Application\Readers;

interface DepartmentReaderInterface
{
    public function all(): array;

    public function count(): int;
}