<?php

namespace App\Modules\QualityAssessment\Application\UseCases\Criteria;

use App\Modules\QualityAssessment\Domain\Entities\Criteria;
use App\Modules\QualityAssessment\Domain\Repositories\CriteriaRepositoryInterface;
use App\Shared\Logging\LoggerInterface;

final class DeleteCriteriaUseCase
{
    public function __construct(
        private CriteriaRepositoryInterface $repository,
        private LoggerInterface $logger
    ) {}

    public function execute(string $id, string $actor_id): void
    {
        $criteria = $this->repository->findOrFail($id);

        $this->repository->delete($criteria);

        $this->writeLog($criteria, $actor_id);
    }

    private function writeLog(Criteria $criteria, string $actor_id): void
    {
        $this->logger->write(
            'info',
            'delete', 
            "Người dùng {$actor_id} đã xóa 1 tiêu chí. Mã tiêu chí: {$criteria->getId()}", 
            $actor_id, 
            [
                'id' => $criteria->getId(),
                'name' => $criteria->getName(),
                'standard_id' => $criteria->getStandardId()
            ]
        );
    }
}