<?php

namespace App\Modules\QualityAssessment\Infrastructure\Repositories;

use App\Modules\QualityAssessment\Domain\Entities\Criteria as EntitiesCriteria;
use App\Modules\QualityAssessment\Domain\Repositories\CriteriaRepositoryInterface;
use App\Modules\QualityAssessment\Infrastructure\Mappers\CriteriaMapper;
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

    public function findOrFail(string $id): EntitiesCriteria
    {
        $modelsCritria = ModelsCriteria::findOrFail($id);

        return CriteriaMapper::toDomain($modelsCritria);
    }

    public function delete(EntitiesCriteria $entitiesCriteria): void
    {
        ModelsCriteria::where('id', $entitiesCriteria->getId())->delete();
    }

    public function save(EntitiesCriteria $entitiesCriteria): void
    {
        $modelsCriteria = ModelsCriteria::findOrFail($entitiesCriteria->getId());

        $modelsCriteria->standard_id = $entitiesCriteria->getStandardId();
        $modelsCriteria->name = $entitiesCriteria->getName();

        $modelsCriteria->save();
    }
}