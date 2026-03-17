<?php

namespace App\Modules\QualityAssessment\Application\UseCases\MilestoneEvidence;

use App\Modules\QualityAssessment\Application\Requests\MilestoneEvidence\CreateMilestoneEvidenceRequestInterface;
use App\Modules\QualityAssessment\Domain\Entities\MilestoneEvidence;
use App\Modules\QualityAssessment\Domain\Repositories\MilestoneEvidenceRepositoryInterface;
use App\Modules\QualityAssessment\Domain\ValueObjects\Evidence\EvidenceId;
use App\Shared\Logging\LoggerInterface;

final class CreateMilestoneEvidenceUseCase
{
    public function __construct(
        private MilestoneEvidenceRepositoryInterface $repository,
        private LoggerInterface $logger
    ) {}

    public function execute(CreateMilestoneEvidenceRequestInterface $request, string $actor_id): void
    {
        $milestoneEvidence = MilestoneEvidence::create(
            EvidenceId::fromString($request->getEvidenceId()),
            $request->getMilestoneId()
        );

        $this->repository->create($milestoneEvidence);
        $this->writeLog($request, $actor_id);
    }

    public function writeLog(CreateMilestoneEvidenceRequestInterface $request, string $actor_id): void
    {
        $this->logger->write(
            'info',
            'create', 
            "Người dùng {$actor_id} đã thêm 1 mốc đánh giá vào minh chứng {$request->getEvidenceId()}", 
            $actor_id, 
            [
                'evidence_id' => $request->getEvidenceId(),
                'criteria_id' => $request->getCriteriaId(),
                'milestone_id' => $request->getMilestoneId()
            ]
        );
    }
}