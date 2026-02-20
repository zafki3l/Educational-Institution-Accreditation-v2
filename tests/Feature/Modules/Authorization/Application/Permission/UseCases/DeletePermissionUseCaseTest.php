<?php

declare(strict_types=1);

namespace Tests\Feature\Modules\Authorization\Application\Permission\UseCases;

use App\Modules\Authorization\Application\Permission\UseCases\DeletePermissionUseCase;
use App\Modules\Authorization\Domain\Entities\Permission;
use App\Modules\Authorization\Domain\Repositories\PermissionRepositoryInterface;
use App\Shared\Logging\LoggerInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class DeletePermissionUseCaseTest extends TestCase
{
    private PermissionRepositoryInterface|MockObject $permissionRepository;
    private LoggerInterface|MockObject $logger;
    private DeletePermissionUseCase $useCase;

    protected function setUp(): void
    {
        $this->permissionRepository = $this->createMock(PermissionRepositoryInterface::class);
        $this->logger = $this->createMock(LoggerInterface::class);
        $this->useCase = new DeletePermissionUseCase($this->permissionRepository, $this->logger);
    }

    public function testExecuteDeletesPermissionSuccessfully(): void
    {
        $permissionId = 'perm-read-user';
        $actorId = 'user-123';

        $permission = Permission::create($permissionId, 'Read User');

        $this->permissionRepository->expects($this->once())
            ->method('findOrFail')
            ->with($permissionId)
            ->willReturn($permission);

        $this->permissionRepository->expects($this->once())
            ->method('delete')
            ->with($permission);

        $this->logger->expects($this->once())
            ->method('write')
            ->with(
                'info',
                'create',
                $this->stringContains($permissionId),
                $actorId,
                $this->callback(function ($data) use ($permissionId) {
                    return isset($data['id']) && $data['id'] === $permissionId;
                })
            );

        $this->useCase->execute($permissionId, $actorId);
    }

    public function testExecuteCallsRepositoryFindOrFail(): void
    {
        $permissionId = 'perm-write-system';

        $permission = Permission::create($permissionId, 'Write System');

        $this->permissionRepository->expects($this->once())
            ->method('findOrFail')
            ->with($permissionId)
            ->willReturn($permission);

        $this->permissionRepository->method('delete');
        $this->logger->method('write');

        $this->useCase->execute($permissionId, 'user-id');
    }

    public function testExecuteCallsRepositoryDelete(): void
    {
        $permissionId = 'perm-delete-user';

        $permission = Permission::create($permissionId, 'Delete User');

        $this->permissionRepository->method('findOrFail')
            ->willReturn($permission);

        $this->permissionRepository->expects($this->once())
            ->method('delete')
            ->with($permission);

        $this->logger->method('write');

        $this->useCase->execute($permissionId, 'admin-id');
    }

    public function testExecuteCallsLoggerWriteMethod(): void
    {
        $permissionId = 'perm-update-config';

        $permission = Permission::create($permissionId, 'Update Configuration');

        $this->permissionRepository->method('findOrFail')
            ->willReturn($permission);

        $this->permissionRepository->method('delete');

        $this->logger->expects($this->once())
            ->method('write');

        $this->useCase->execute($permissionId, 'user-id');
    }

    public function testExecutePassesCorrectPermissionIdToLogger(): void
    {
        $permissionId = 'perm-manage-auth';
        $actorId = 'specific-user-789';

        $permission = Permission::create($permissionId, 'Manage Authorization');

        $this->permissionRepository->method('findOrFail')
            ->willReturn($permission);

        $this->permissionRepository->method('delete');

        $this->logger->expects($this->once())
            ->method('write')
            ->with(
                $this->anything(),
                $this->anything(),
                $this->anything(),
                $this->anything(),
                $this->callback(function ($data) use ($permissionId) {
                    return isset($data['id']) && $data['id'] === $permissionId;
                })
            );

        $this->useCase->execute($permissionId, $actorId);
    }

    public function testExecutePassesCorrectActorIdToLogger(): void
    {
        $permissionId = 'perm-id';
        $actorId = 'specific-actor-456';

        $permission = Permission::create($permissionId, 'Test Permission');

        $this->permissionRepository->method('findOrFail')
            ->willReturn($permission);

        $this->permissionRepository->method('delete');

        $this->logger->expects($this->once())
            ->method('write')
            ->with(
                $this->anything(),
                $this->anything(),
                $this->anything(),
                $actorId,
                $this->anything()
            );

        $this->useCase->execute($permissionId, $actorId);
    }

    public function testExecuteLogsDeleteAction(): void
    {
        $permissionId = 'perm-id';

        $permission = Permission::create($permissionId, 'Test');

        $this->permissionRepository->method('findOrFail')
            ->willReturn($permission);

        $this->permissionRepository->method('delete');

        $this->logger->expects($this->once())
            ->method('write')
            ->with('info', 'create');

        $this->useCase->execute($permissionId, 'user-id');
    }
}
