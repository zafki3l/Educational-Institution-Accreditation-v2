<?php

namespace App\Modules\QualityAssessment\Infrastructure\Services;

use App\Modules\QualityAssessment\Domain\Services\CriteriaIdExistsCheckerInterface;
use App\Modules\QualityAssessment\Infrastructure\Models\Criteria;

final class CriteriaIdExistsChecker implements CriteriaIdExistsCheckerInterface
{
    public function check(string $id): bool
    {
        return Criteria::query()
                ->where('id', $id)
                ->exists();
    }
}