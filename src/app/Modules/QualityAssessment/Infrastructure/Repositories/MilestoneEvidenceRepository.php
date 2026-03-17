<?php

namespace App\Modules\QualityAssessment\Infrastructure\Repositories;

use App\Modules\QualityAssessment\Domain\Entities\MilestoneEvidence as EntitiesMilestoneEvidence;
use App\Modules\QualityAssessment\Domain\Repositories\MilestoneEvidenceRepositoryInterface;
use App\Modules\QualityAssessment\Infrastructure\Models\MilestoneEvidence as ModelsMilestoneEvidence;

class MilestoneEvidenceRepository implements MilestoneEvidenceRepositoryInterface
{
    public function create(EntitiesMilestoneEvidence $entitiesMilestoneEvidence): void
    {
        ModelsMilestoneEvidence::create([
            'evidence_id' => $entitiesMilestoneEvidence->getEvidenceId()->value(),
            'milestone_id' => $entitiesMilestoneEvidence->getMilestoneId()
        ]);
    }
}