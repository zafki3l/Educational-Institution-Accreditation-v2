<?php

namespace App\Modules\Authorization\Application\Role\UseCases;

use App\Modules\Authorization\Application\Role\Requests\CreateRoleRequestInterface;
use App\Modules\Authorization\Domain\Entities\Role;
use App\Modules\Authorization\Domain\Repositories\RoleRepositoryInterface;
use App\Shared\Logging\LoggerInterface;

final class CreateRoleUseCase
{
    public function __construct(
        private RoleRepositoryInterface $repository,
        private LoggerInterface $logger
    ) {}

    public function execute(CreateRoleRequestInterface $request, string $actor_id): void
    {
        $role = Role::create($request->getName());

        $this->repository->create($role);

        $this->writeLog($request, $actor_id);
    }

    private function writeLog(CreateRoleRequestInterface $request, string $actor_id): void
    {
        $this->logger->write(
            'info',
            'create', 
            "Người dùng {$actor_id} đã thêm 1 vai trò mới", 
            $actor_id, 
            ['name' => $request->getName()]
        );
    }
}