<?php

namespace App\Modules\QualityAssessment\Infrastructure\Repositories;

use App\Modules\QualityAssessment\Domain\Entities\Criteria as EntitiesCriteria;
use App\Modules\QualityAssessment\Domain\Repositories\CriteriaRepositoryInterface;
use App\Modules\QualityAssessment\Infrastructure\Models\Criteria as ModelsCriteria;

class CriteriaRepository implements CriteriaRepositoryInterface
{
    public function create(EntitiesCriteria $entitiesCriteria): void
    {
        ModelsCriteria::create([
            'id' => $entitiesCriteria->getId(),
            'standard_id' => $entitiesCriteria->getStandardId(),
            'name' => $entitiesCriteria->getName()
        ]);
    }
}