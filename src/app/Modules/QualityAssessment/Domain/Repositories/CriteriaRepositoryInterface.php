<?php

namespace App\Modules\QualityAssessment\Domain\Repositories;

use App\Modules\QualityAssessment\Domain\Entities\Criteria as EntitiesCriteria;

interface CriteriaRepositoryInterface
{
    public function create(EntitiesCriteria $entitiesCriteria): void;

    public function findOrFail(string $id): EntitiesCriteria;

    public function delete(EntitiesCriteria $entitiesCriteria): void;
}