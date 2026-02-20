<?php

namespace App\Modules\Authorization\Application\Permission\UseCases;

use App\Modules\Authorization\Application\Permission\Requests\CreatePermissionRequestInterface;
use App\Modules\Authorization\Domain\Entities\Permission;
use App\Modules\Authorization\Domain\Repositories\PermissionRepositoryInterface;
use App\Shared\Logging\LoggerInterface;

class CreatePermissionUseCase
{
    public function __construct(
        private PermissionRepositoryInterface $repository,
        private LoggerInterface $logger
    ) {}
    public function execute(CreatePermissionRequestInterface $request, string $actor_id): void
    {
        $permission = Permission::create(
            $request->getId(),
            $request->getName()
        );

        $this->repository->create($permission);

        $this->writeLog($request, $actor_id);
    }

    private function writeLog(CreatePermissionRequestInterface $request, string $actor_id): void
    {
        $this->logger->write(
            'info',
            'create', 
            "Người dùng {$actor_id} đã thêm 1 quyền mới", 
            $actor_id, 
            ['name' => $request->getName()]
        );
    }
}