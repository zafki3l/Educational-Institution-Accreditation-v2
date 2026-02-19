<?php

namespace App\Modules\QualityAssessment\Infrastructure\Readers;

use App\Modules\QualityAssessment\Infrastructure\Models\Standard;
use App\Shared\Application\Contracts\StandardReader\StandardReaderInterface;
use Illuminate\Database\Eloquent\Collection;

class StandardReader implements StandardReaderInterface
{
    public function all(): Collection
    {
        $standards = Standard::with('department')->get();

        return $standards;
    }

    public function withCriteria(): Collection
    {
        $standards = Standard::with('criteria')->get();

        return $standards;
    }

    public function count(): int
    {
        return Standard::count();
    }
}