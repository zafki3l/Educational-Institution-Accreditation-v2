<?php

namespace App\Modules\QualityAssessment\Application\UseCases\Milestone;

use App\Modules\QualityAssessment\Application\Requests\Milestone\CreateMilestoneRequestInterface;
use App\Modules\QualityAssessment\Domain\Entities\Milestone;
use App\Modules\QualityAssessment\Domain\Repositories\MilestoneRepositoryInterface;
use App\Shared\Logging\LoggerInterface;

final class CreateMilestoneUseCase
{
    public function __construct(
        private MilestoneRepositoryInterface $repository,
        private LoggerInterface $logger
    ) {}

    public function execute(CreateMilestoneRequestInterface $request, string $actor_id): Milestone
    {
        $milestone = Milestone::create(
            null,
            $request->getCriteriaId(),
            "{$request->getCriteriaId()}.{$request->getOrder()}",
            $request->getOrder(),
            $request->getName()
        );

        $created = $this->repository->create($milestone);

        $this->writeLog($created, $actor_id);

        return $created;
    }

    private function writeLog(Milestone $milestone, string $actor_id): void
    {
        $this->logger->write(
            'info',
            'create', 
            "Người dùng {$actor_id} đã thêm 1 mốc đánh giá mới", 
            $actor_id, 
            [
                'id' => $milestone->getId(),
                'criteria_id' => $milestone->getCriteriaId(),
                'code' => $milestone->getCode(),
                'order' => $milestone->getOrder(),
                'name' => $milestone->getName(),
            ]
        );
    }
}