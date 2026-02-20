<?php

namespace App\Modules\QualityAssessment\Infrastructure\Mappers;

use App\Modules\QualityAssessment\Domain\Entities\Milestone as EntitiesMilestone;
use App\Modules\QualityAssessment\Domain\ValueObjects\Milestone\MilestoneCode;
use App\Modules\QualityAssessment\Infrastructure\Models\Milestone as ModelsMilestone;

class MilestoneMapper
{
    public static function toDomain(ModelsMilestone $modelsMilestone): EntitiesMilestone
    {
        return EntitiesMilestone::create(
            $modelsMilestone->id,
            $modelsMilestone->criteria_id,
            MilestoneCode::fromString($modelsMilestone->code),
            $modelsMilestone->order,
            $modelsMilestone->name
        );
    }
}