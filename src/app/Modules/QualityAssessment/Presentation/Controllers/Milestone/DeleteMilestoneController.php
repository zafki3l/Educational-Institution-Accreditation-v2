<?php

namespace App\Modules\QualityAssessment\Presentation\Controllers\Milestone;

use App\Modules\QualityAssessment\Infrastructure\Models\Milestone;
use App\Modules\QualityAssessment\Presentation\Controllers\QualityAssessmentController;
use App\Shared\Response\JsonResponse;

final class DeleteMilestoneController extends QualityAssessmentController
{
    public function destroy(string $id)
    {
        $milestone = Milestone::findOrFail($id);
        
        $milestone->delete();

        return new JsonResponse([]);
    }
}