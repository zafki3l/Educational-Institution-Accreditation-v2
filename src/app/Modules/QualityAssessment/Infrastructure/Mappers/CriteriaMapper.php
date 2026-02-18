<?php

namespace App\Modules\QualityAssessment\Infrastructure\Mappers;

use App\Modules\QualityAssessment\Domain\Entities\Criteria as EntitiesCriteria;
use App\Modules\QualityAssessment\Infrastructure\Models\Criteria as ModelsCriteria;

class CriteriaMapper
{
    public static function toDomain(ModelsCriteria $modelsCriteria): EntitiesCriteria
    {
        return EntitiesCriteria::create(
            $modelsCriteria->id,
            $modelsCriteria->standard_id,
            $modelsCriteria->name
        );
    }
}