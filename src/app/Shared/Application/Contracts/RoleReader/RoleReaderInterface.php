<?php

namespace App\Shared\Application\Contracts\RoleReader;

use App\Shared\Application\DTOs\RoleView\RoleViewDTO;

interface RoleReaderInterface
{
    public function all(): array;
}