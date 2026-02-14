<?php

namespace App\Shared\Application\Contracts\UserReader;

use App\Modules\UserManagement\Application\DTOs\EditUserViewDTO;
use App\Shared\Application\DTOs\Paginator\PaginatedResultDTO;

interface UserReaderInterface
{
    public function all(?string $keyword, ?int $role_id): PaginatedResultDTO;

    public function findById(string $id): EditUserViewDTO;

    public function count(): int;
}