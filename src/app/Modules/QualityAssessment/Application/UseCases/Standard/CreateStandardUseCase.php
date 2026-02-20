<?php

namespace App\Modules\QualityAssessment\Application\UseCases\Standard;

use App\Modules\QualityAssessment\Application\Requests\Standard\CreateStandardRequestInterface;
use App\Modules\QualityAssessment\Domain\Entities\Standard;
use App\Modules\QualityAssessment\Domain\Repositories\StandardRepositoryInterface;
use App\Shared\Logging\LoggerInterface;

final class CreateStandardUseCase
{
    public function __construct(
        private StandardRepositoryInterface $repository,
        private LoggerInterface $logger
    ) {}

    public function execute(CreateStandardRequestInterface $request, string $actor_id): void
    {
        $standard = Standard::create(
            $request->getId(),
            $request->getName(),
            $request->getDepartmentId()
        );

        $this->repository->create($standard);

        $this->writeLog($request, $actor_id);
    }

    private function writeLog(CreateStandardRequestInterface $request, string $actor_id): void
    {
        $this->logger->write(
            'info',
            'create', 
            "Người dùng {$actor_id} đã thêm 1 tiêu chuẩn mới", 
            $actor_id, 
            [
                'id' => $request->getId(),
                'name' => $request->getName(),
                'department_id' => $request->getDepartmentId()
            ]
        );
    }
}