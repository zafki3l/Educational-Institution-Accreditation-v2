<?php

namespace App\Modules\QualityAssessment\Presentation\Controllers\Milestone;

use App\Modules\QualityAssessment\Infrastructure\Models\Milestone;
use App\Modules\QualityAssessment\Presentation\Controllers\QualityAssessmentController;
use App\Modules\QualityAssessment\Presentation\Requests\Milestone\CreateMilestoneRequest;
use App\Shared\Response\JsonResponse;

final class CreateMilestoneController extends QualityAssessmentController
{
    public function store(CreateMilestoneRequest $request)
    {
        $milestone = Milestone::create([
            'criteria_id' => $request->getCriteriaId(),
            'code' => "{$request->getCriteriaId()}.{$request->getOrder()}",
            'order' => $request->getOrder(),
            'name' => $request->getName()
        ]);

        return new JsonResponse([
            'id' => $milestone->id,
            'criteria_id' => $milestone->criteria_id,
            'code' => "{$milestone->criteria_id}.{$milestone->order}",
            'order' => $milestone->order,
            'name' => $milestone->name
        ]);
    }
}