<?php

namespace App\Modules\DepartmentManagement\Application\UseCases;

use App\Modules\DepartmentManagement\Domain\Repositories\DepartmentRepositoryInterface;
use App\Shared\Logging\LoggerInterface;

final class DeleteDepartmentUseCase
{
    public function __construct(
        private DepartmentRepositoryInterface $repository,
        private LoggerInterface $logger
    ) {}

    public function execute(string $id, string $actor_id): void
    {
        $department = $this->repository->findOrFail($id);

        $this->repository->delete($department);

        $this->writeLog($id, $actor_id);
    }

    private function writeLog(string $id, string $actor_id): void
    {
        $this->logger->write(
            'info',
            'delete', 
            "Người dùng {$actor_id} đã xóa 1 phòng ban: {$id}", 
            $actor_id, 
            ['id' => $id]
        );
    }
}