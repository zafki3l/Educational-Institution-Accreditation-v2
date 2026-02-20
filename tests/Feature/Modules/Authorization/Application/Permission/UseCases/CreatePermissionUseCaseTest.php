<?php

declare(strict_types=1);

namespace Tests\Feature\Modules\Authorization\Application\Permission\UseCases;

use App\Modules\Authorization\Application\Permission\Requests\CreatePermissionRequestInterface;
use App\Modules\Authorization\Application\Permission\UseCases\CreatePermissionUseCase;
use App\Modules\Authorization\Domain\Entities\Permission;
use App\Modules\Authorization\Domain\Repositories\PermissionRepositoryInterface;
use App\Shared\Logging\LoggerInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class CreatePermissionUseCaseTest extends TestCase
{
    private PermissionRepositoryInterface|MockObject $permissionRepository;
    private LoggerInterface|MockObject $logger;
    private CreatePermissionUseCase $useCase;

    protected function setUp(): void
    {
        $this->permissionRepository = $this->createMock(PermissionRepositoryInterface::class);
        $this->logger = $this->createMock(LoggerInterface::class);
        $this->useCase = new CreatePermissionUseCase($this->permissionRepository, $this->logger);
    }

    public function testExecuteCreatesPermissionSuccessfully(): void
    {
        $request = $this->createMock(CreatePermissionRequestInterface::class);
        $request->method('getId')->willReturn('perm-read-user');
        $request->method('getName')->willReturn('Read User');

        $actorId = 'user-123';

        $this->permissionRepository->expects($this->once())
            ->method('create')
            ->with($this->callback(function (Permission $permission) {
                return $permission->getId() === 'perm-read-user'
                    && $permission->getName() === 'Read User';
            }));

        $this->logger->expects($this->once())
            ->method('write')
            ->with(
                'info',
                'create',
                $this->stringContains('user-123'),
                'user-123',
                $this->callback(function ($data) {
                    return isset($data['name']) && $data['name'] === 'Read User';
                })
            );

        $this->useCase->execute($request, $actorId);
    }

    public function testExecuteCallsRepositoryCreateMethod(): void
    {
        $request = $this->createMock(CreatePermissionRequestInterface::class);
        $request->method('getId')->willReturn('perm-write-system');
        $request->method('getName')->willReturn('Write System');

        $this->permissionRepository->expects($this->once())
            ->method('create');

        $this->useCase->execute($request, 'actor-id');
    }

    public function testExecuteCallsLoggerWriteMethod(): void
    {
        $request = $this->createMock(CreatePermissionRequestInterface::class);
        $request->method('getId')->willReturn('perm-delete-user');
        $request->method('getName')->willReturn('Delete User');

        $this->logger->expects($this->once())
            ->method('write');

        $this->useCase->execute($request, 'actor-id');
    }

    public function testExecutePassesCorrectActorIdToLogger(): void
    {
        $request = $this->createMock(CreatePermissionRequestInterface::class);
        $request->method('getId')->willReturn('perm-id');
        $request->method('getName')->willReturn('Permission Name');

        $actorId = 'specific-user-456';

        $this->logger->expects($this->once())
            ->method('write')
            ->with(
                $this->anything(),
                $this->anything(),
                $this->anything(),
                $actorId,
                $this->anything()
            );

        $this->useCase->execute($request, $actorId);
    }

    public function testExecutePassesPermissionNameToLogger(): void
    {
        $permissionName = 'Manage Authorization';
        $request = $this->createMock(CreatePermissionRequestInterface::class);
        $request->method('getId')->willReturn('perm-manage-auth');
        $request->method('getName')->willReturn($permissionName);

        $this->logger->expects($this->once())
            ->method('write')
            ->with(
                $this->anything(),
                $this->anything(),
                $this->anything(),
                $this->anything(),
                $this->callback(function ($data) use ($permissionName) {
                    return isset($data['name']) && $data['name'] === $permissionName;
                })
            );

        $this->useCase->execute($request, 'user-id');
    }

    public function testExecuteLogsCreateAction(): void
    {
        $request = $this->createMock(CreatePermissionRequestInterface::class);
        $request->method('getId')->willReturn('perm-id');
        $request->method('getName')->willReturn('Test Permission');

        $this->logger->expects($this->once())
            ->method('write')
            ->with('info', 'create');

        $this->useCase->execute($request, 'user-id');
    }

    public function testExecuteLogsInfoLevel(): void
    {
        $request = $this->createMock(CreatePermissionRequestInterface::class);
        $request->method('getId')->willReturn('perm-id');
        $request->method('getName')->willReturn('Test Permission');

        $this->logger->expects($this->once())
            ->method('write')
            ->with('info', $this->anything(), $this->anything(), $this->anything(), $this->anything());

        $this->useCase->execute($request, 'user-id');
    }
}
