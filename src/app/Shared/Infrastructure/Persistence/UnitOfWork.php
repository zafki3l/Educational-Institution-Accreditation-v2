<?php

namespace App\Shared\Infrastructure\Persistence;

use App\Shared\Contracts\UnitOfWork\UnitOfWorkInterface;
use Illuminate\Database\ConnectionInterface;

class UnitOfWork implements UnitOfWorkInterface
{
    public function __construct(private ConnectionInterface $db) {}

    public function execute(callable $work): mixed
    {
        return $this->db->transaction($work);
    }
}
