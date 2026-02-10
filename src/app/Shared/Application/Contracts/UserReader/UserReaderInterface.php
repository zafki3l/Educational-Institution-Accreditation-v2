<?php

namespace App\Shared\Application\Contracts\UserReader;

use App\Modules\UserManagement\Application\DTOs\EditUserViewDTO;

interface UserReaderInterface
{
    public function all(): array;

    public function findById(string $id): EditUserViewDTO;

    public function count(): int;
}