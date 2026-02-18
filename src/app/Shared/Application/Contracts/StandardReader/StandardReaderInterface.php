<?php

namespace App\Shared\Application\Contracts\StandardReader;

use Illuminate\Database\Eloquent\Collection;

interface StandardReaderInterface
{
    public function all(): Collection;

    public function withCriteria(): Collection;
}