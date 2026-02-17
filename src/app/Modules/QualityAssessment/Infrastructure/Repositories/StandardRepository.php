<?php

namespace App\Modules\QualityAssessment\Infrastructure\Repositories;

use App\Modules\QualityAssessment\Domain\Entities\Standard as EntitiesStandard;
use App\Modules\QualityAssessment\Domain\Repositories\StandardRepositoryInterface;
use App\Modules\QualityAssessment\Infrastructure\Mappers\StandardMapper;
use App\Modules\QualityAssessment\Infrastructure\Models\Standard as ModelsStandard;

class StandardRepository implements StandardRepositoryInterface
{
    public function create(EntitiesStandard $entitiesStandard): void
    {
        ModelsStandard::create([
            'id' => $entitiesStandard->getId(),
            'name' => $entitiesStandard->getName(),
            'department_id' => $entitiesStandard->getDepartmentId()
        ]);
    }

    public function findOrFail(string $id): EntitiesStandard
    {
        $modelsStandard = ModelsStandard::findOrFail($id);

        return StandardMapper::toDomain($modelsStandard);
    }

    public function delete(EntitiesStandard $entitiesStandard): void
    {
        ModelsStandard::where('id', $entitiesStandard->getId())->delete();
    }
}
