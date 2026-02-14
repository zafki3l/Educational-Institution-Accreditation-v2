<?php

namespace App\Shared\Application\DTOs\Paginator;

class PaginatedResultDTO
{
    public function __construct(
        public array $items,
        public int $currentPage,
        public int $perPage,
        public int $total,
        public int $lastPage,
    ) {}
}