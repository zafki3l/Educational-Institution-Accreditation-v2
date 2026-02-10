<?php

namespace App\Shared\Application\Contracts\UserReader;

interface UserReaderInterface
{
    public function all(): array;
    
    public function count(): int;
}