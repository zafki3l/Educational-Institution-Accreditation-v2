<?php

namespace App\Modules\QualityAssessment\Domain\Services;

interface CriteriaIdExistsCheckerInterface
{
    public function check(string $id): bool;
}