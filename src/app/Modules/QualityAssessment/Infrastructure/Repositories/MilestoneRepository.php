<?php

namespace App\Modules\QualityAssessment\Infrastructure\Repositories;

use App\Modules\QualityAssessment\Domain\Entities\Milestone as EntitiesMilestone;
use App\Modules\QualityAssessment\Domain\Repositories\MilestoneRepositoryInterface;
use App\Modules\QualityAssessment\Infrastructure\Mappers\MilestoneMapper;
use App\Modules\QualityAssessment\Infrastructure\Models\Milestone as ModelsMilestone;

class MilestoneRepository implements MilestoneRepositoryInterface
{
    public function create(EntitiesMilestone $entitiesMilestone): EntitiesMilestone
    {
        $modelsMilestone = ModelsMilestone::create([
            'criteria_id' => $entitiesMilestone->getCriteriaId(),
            'code' => "{$entitiesMilestone->getCriteriaId()}.{$entitiesMilestone->getOrder()}",
            'order' => $entitiesMilestone->getOrder(),
            'name' => $entitiesMilestone->getName()
        ]);

        return MilestoneMapper::toDomain($modelsMilestone);
    }

    public function findOrFail(int $id): EntitiesMilestone
    {
        $modelsMilestone = ModelsMilestone::findOrFail($id);

        return MilestoneMapper::toDomain($modelsMilestone);
    }

    public function delete(EntitiesMilestone $entitiesMilestone): void
    {
        ModelsMilestone::where('id', $entitiesMilestone->getId())->delete();
    }
}