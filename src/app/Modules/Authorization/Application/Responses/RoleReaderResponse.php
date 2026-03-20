<?php

namespace App\Modules\Authorization\Application\Responses;

final class RoleReaderResponse
{
    public function __construct(
        public readonly int $id, 
        public readonly string $name
    ) {}
}