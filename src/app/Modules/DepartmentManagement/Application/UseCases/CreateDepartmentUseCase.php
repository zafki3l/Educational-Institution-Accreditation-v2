<?php

namespace App\Modules\DepartmentManagement\Application\UseCases;

use App\Modules\DepartmentManagement\Application\Requests\CreateDepartmentRequestInterface;
use App\Modules\DepartmentManagement\Domain\Entities\Department;
use App\Modules\DepartmentManagement\Domain\Repositories\DepartmentRepositoryInterface;
use App\Shared\Logging\LoggerInterface;

final class CreateDepartmentUseCase 
{
    public function __construct(
        private DepartmentRepositoryInterface $repository,
        private LoggerInterface $logger
    ) {}

    public function execute(CreateDepartmentRequestInterface $request, string $actor_id): void
    {
        $department = Department::create(
            $request->getId(),
            $request->getName()
        );

        $this->repository->create($department);

        $this->writeLog($request, $actor_id);
    }

    private function writeLog(CreateDepartmentRequestInterface $request, string $actor_id): void
    {
        $this->logger->write(
            'info',
            'create', 
            "Người dùng {$actor_id} đã thêm 1 phòng ban mới", 
            $actor_id, 
            ['name' => $request->getName()]
        );
    }
}