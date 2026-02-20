<?php

namespace App\Modules\Authorization\Application\Permission\UseCases;

use App\Modules\Authorization\Domain\Repositories\PermissionRepositoryInterface;
use App\Shared\Logging\LoggerInterface;

class DeletePermissionUseCase
{
    public function __construct(
        private PermissionRepositoryInterface $repository,
        private LoggerInterface $logger
    ) {}
    
    public function execute(string $id, string $actor_id): void
    {
        $permission = $this->repository->findOrFail($id);

        $this->repository->delete($permission);

        $this->writeLog($id, $actor_id);
    }

    private function writeLog(string $id, string $actor_id): void
    {
        $this->logger->write(
            'info',
            'create', 
            "Người dùng {$actor_id} đã xóa 1 quyền: {$id}", 
            $actor_id, 
            ['id' => $id]
        );
    }
}