<?php

namespace App\Modules\QualityAssessment\Domain\Repositories;

use App\Modules\QualityAssessment\Domain\Entities\Standard as EntitiesStandard;

interface StandardRepositoryInterface
{
    public function create(EntitiesStandard $entitiesStandard): void;
}