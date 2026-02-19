<?php

namespace App\Modules\QualityAssessment\Infrastructure\Readers;

use App\Modules\QualityAssessment\Infrastructure\Models\Criteria;
use App\Shared\Application\Contracts\CriteriaReader\CriteriaReaderInterface;

class CriteriaReader implements CriteriaReaderInterface
{
    public function count(): int
    {
        return Criteria::count();
    }
}