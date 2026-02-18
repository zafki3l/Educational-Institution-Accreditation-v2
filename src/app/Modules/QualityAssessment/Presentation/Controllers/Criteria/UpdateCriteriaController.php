<?php

namespace App\Modules\QualityAssessment\Presentation\Controllers\Criteria;

use App\Modules\QualityAssessment\Infrastructure\Models\Criteria;
use App\Modules\QualityAssessment\Presentation\Controllers\QualityAssessmentController;
use App\Shared\Response\JsonResponse;

final class UpdateCriteriaController extends QualityAssessmentController
{
    public function edit(string $id): JsonResponse
    {
        $criterias = Criteria::findOrFail($id);

        return new JsonResponse([
            'id' => $criterias->id,
            'standard_id' => $criterias->standard_id,
            'name' => $criterias->name
        ]);
    }

    public function update()
    {

    }
}