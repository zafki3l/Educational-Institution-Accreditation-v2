<?php

namespace App\Modules\QualityAssessment\Domain\Repositories;

use App\Modules\QualityAssessment\Domain\Entities\Milestone as EntitiesMilestone;

interface MilestoneRepositoryInterface
{
    public function create(EntitiesMilestone $entitiesMilestone): EntitiesMilestone;

    public function findOrFail(int $id): EntitiesMilestone;

    public function delete(EntitiesMilestone $entitiesMilestone): void;
}