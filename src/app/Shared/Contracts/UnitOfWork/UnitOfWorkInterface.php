<?php

namespace App\Shared\Contracts\UnitOfWork;

interface UnitOfWorkInterface
{
    public function execute(callable $work): mixed;
}