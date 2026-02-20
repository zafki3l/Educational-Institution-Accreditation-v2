<?php

namespace App\Modules\QualityAssessment\Application\UseCases\Standard;

use App\Modules\QualityAssessment\Domain\Entities\Standard;
use App\Modules\QualityAssessment\Domain\Repositories\StandardRepositoryInterface;
use App\Shared\Logging\LoggerInterface;

final class DeleteStandardUseCase
{
    public function __construct(
        private StandardRepositoryInterface $repository,
        private LoggerInterface $logger
    ) {}

    public function execute(string $id, string $actor_id)
    {
        $standard = $this->repository->findOrFail($id);

        $this->repository->delete($standard);

        $this->writeLog($standard, $actor_id);
    }

    private function writeLog(Standard $standard, string $actor_id): void
    {
        $this->logger->write(
            'info',
            'delete', 
            "Người dùng {$actor_id} đã xóa 1 tiêu chuẩn. Mã tiêu chuẩn: {$standard->getId()}", 
            $actor_id, 
            [
                'id' => $standard->getId(),
                'name' => $standard->getName(),
                'department_id' => $standard->getDepartmentId()
            ]
        );
    }
}