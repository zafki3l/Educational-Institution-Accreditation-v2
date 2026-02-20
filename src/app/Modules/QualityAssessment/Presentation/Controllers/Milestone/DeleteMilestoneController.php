<?php

namespace App\Modules\QualityAssessment\Presentation\Controllers\Milestone;

use App\Modules\QualityAssessment\Application\UseCases\Milestone\DeleteMilestoneUseCase;
use App\Modules\QualityAssessment\Presentation\Controllers\QualityAssessmentController;
use App\Shared\Response\JsonResponse;
use App\Shared\SessionManager\AuthSession;

final class DeleteMilestoneController extends QualityAssessmentController
{
    public function __construct(private DeleteMilestoneUseCase $deleteMilestoneUseCase) {}

    public function destroy(int $id)
    {
        $this->deleteMilestoneUseCase->execute($id, AuthSession::getUserId());

        return new JsonResponse([]);
    }
}