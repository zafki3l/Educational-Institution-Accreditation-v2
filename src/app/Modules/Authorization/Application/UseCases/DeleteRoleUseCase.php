<?php

namespace App\Modules\Authorization\Application\UseCases;

use App\Modules\Authorization\Domain\Repositories\RoleRepositoryInterface;
use App\Shared\Logging\LoggerInterface;

final class DeleteRoleUseCase
{
    public function __construct(
        private RoleRepositoryInterface $repository,
        private LoggerInterface $logger
    ) {}

    public function execute(int $id, string $actor_id)
    {
        $role = $this->repository->findOrFail($id);

        $this->repository->delete($role);

        $this->writeLog($id, $actor_id);
    }

    private function writeLog(int $id, string $actor_id): void
    {
        $this->logger->write(
            'info',
            'delete', 
            "Người dùng {$actor_id} đã xóa 1 vai trò: {$id}", 
            $actor_id, 
            ['id' => $id]
        );
    }
}