<?php

namespace App\Modules\QualityAssessment\Infrastructure\Mappers;

use App\Modules\QualityAssessment\Domain\Entities\Standard as EntitiesStandard;
use App\Modules\QualityAssessment\Infrastructure\Models\Standard as ModelsStandard;

class StandardMapper
{
    public static function toDomain(ModelsStandard $modelsStandard): EntitiesStandard
    {
        return EntitiesStandard::create(
            $modelsStandard->id,
            $modelsStandard->name,
            $modelsStandard->department_id
        );
    }
}