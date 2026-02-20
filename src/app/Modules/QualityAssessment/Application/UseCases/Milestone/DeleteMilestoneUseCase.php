<?php

namespace App\Modules\QualityAssessment\Application\UseCases\Milestone;

use App\Modules\QualityAssessment\Domain\Entities\Milestone;
use App\Modules\QualityAssessment\Domain\Repositories\MilestoneRepositoryInterface;
use App\Shared\Logging\LoggerInterface;

final class DeleteMilestoneUseCase
{
    public function __construct(
        private MilestoneRepositoryInterface $repository,
        private LoggerInterface $logger
    ) {}

    public function execute(int $id, string $actor_id): void
    {
        $milestone = $this->repository->findOrFail($id);
        
        $this->repository->delete($milestone);

        $this->writeLog($milestone, $actor_id);
    }

    private function writeLog(Milestone $milestone, string $actor_id): void
    {
        $this->logger->write(
            'info',
            'delete', 
            "Người dùng {$actor_id} đã xóa mốc đánh giá {$milestone->getCode()->value()}", 
            $actor_id, 
            [
                'id' => $milestone->getId(),
                'criteria_id' => $milestone->getCriteriaId(),
                'code' => $milestone->getCode()->value(),
                'order' => $milestone->getOrder(),
                'name' => $milestone->getName(),
            ]
        );
    }
}