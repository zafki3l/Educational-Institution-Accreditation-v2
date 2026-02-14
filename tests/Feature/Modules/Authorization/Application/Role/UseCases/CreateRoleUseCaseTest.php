<?php

declare(strict_types=1);

namespace Tests\Feature\Modules\Authorization\Application\Role\UseCases;

use App\Modules\Authorization\Application\Role\Requests\CreateRoleRequestInterface;
use App\Modules\Authorization\Application\Role\UseCases\CreateRoleUseCase;
use App\Modules\Authorization\Domain\Entities\Role;
use App\Modules\Authorization\Domain\Repositories\RoleRepositoryInterface;
use App\Shared\Logging\LoggerInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class CreateRoleUseCaseTest extends TestCase
{
    private RoleRepositoryInterface|MockObject $roleRepository;
    private LoggerInterface|MockObject $logger;
    private CreateRoleUseCase $useCase;

    protected function setUp(): void
    {
        $this->roleRepository = $this->createMock(RoleRepositoryInterface::class);
        $this->logger = $this->createMock(LoggerInterface::class);
        $this->useCase = new CreateRoleUseCase($this->roleRepository, $this->logger);
    }

    public function testExecuteCreatesRoleSuccessfully(): void
    {
        $request = $this->createMock(CreateRoleRequestInterface::class);
        $request->method('getName')->willReturn('Administrator');

        $actorId = 'user-123';

        $this->roleRepository->expects($this->once())
            ->method('create')
            ->with($this->callback(function (Role $role) {
                return $role->getName() === 'Administrator';
            }));

        $this->logger->expects($this->once())
            ->method('write')
            ->with(
                'info',
                'create',
                $this->stringContains('user-123'),
                'user-123',
                $this->callback(function ($data) {
                    return isset($data['name']) && $data['name'] === 'Administrator';
                })
            );

        $this->useCase->execute($request, $actorId);
    }

    public function testExecuteCallsRepositoryCreateMethod(): void
    {
        $request = $this->createMock(CreateRoleRequestInterface::class);
        $request->method('getName')->willReturn('Manager');

        $this->roleRepository->expects($this->once())
            ->method('create');

        $this->useCase->execute($request, 'actor-id');
    }

    public function testExecuteCallsLoggerWriteMethod(): void
    {
        $request = $this->createMock(CreateRoleRequestInterface::class);
        $request->method('getName')->willReturn('Editor');

        $this->logger->expects($this->once())
            ->method('write');

        $this->useCase->execute($request, 'actor-id');
    }

    public function testExecutePassesCorrectActorIdToLogger(): void
    {
        $request = $this->createMock(CreateRoleRequestInterface::class);
        $request->method('getName')->willReturn('User');

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

    public function testExecutePassesRoleNameToLogger(): void
    {
        $roleName = 'Content Manager';
        $request = $this->createMock(CreateRoleRequestInterface::class);
        $request->method('getName')->willReturn($roleName);

        $this->logger->expects($this->once())
            ->method('write')
            ->with(
                $this->anything(),
                $this->anything(),
                $this->anything(),
                $this->anything(),
                $this->callback(function ($data) use ($roleName) {
                    return isset($data['name']) && $data['name'] === $roleName;
                })
            );

        $this->useCase->execute($request, 'user-id');
    }

    public function testExecuteLogsCreateAction(): void
    {
        $request = $this->createMock(CreateRoleRequestInterface::class);
        $request->method('getName')->willReturn('Moderator');

        $this->logger->expects($this->once())
            ->method('write')
            ->with('info', 'create');

        $this->useCase->execute($request, 'user-id');
    }

    public function testExecuteLogsInfoLevel(): void
    {
        $request = $this->createMock(CreateRoleRequestInterface::class);
        $request->method('getName')->willReturn('Test Role');

        $this->logger->expects($this->once())
            ->method('write')
            ->with('info', $this->anything(), $this->anything(), $this->anything(), $this->anything());

        $this->useCase->execute($request, 'user-id');
    }

    public function testExecuteCreatesNewRoleInstanceForEachCall(): void
    {
        $request1 = $this->createMock(CreateRoleRequestInterface::class);
        $request1->method('getName')->willReturn('Role One');

        $request2 = $this->createMock(CreateRoleRequestInterface::class);
        $request2->method('getName')->willReturn('Role Two');

        $createdRoles = [];

        $this->roleRepository->expects($this->exactly(2))
            ->method('create')
            ->willReturnCallback(function (Role $role) use (&$createdRoles) {
                $createdRoles[] = $role->getName();
            });

        $this->useCase->execute($request1, 'user-id');
        $this->useCase->execute($request2, 'user-id');

        $this->assertCount(2, $createdRoles);
        $this->assertContains('Role One', $createdRoles);
        $this->assertContains('Role Two', $createdRoles);
    }

    public function testExecuteLogsDifferentActorIds(): void
    {
        $request = $this->createMock(CreateRoleRequestInterface::class);
        $request->method('getName')->willReturn('Test Role');

        $actorIds = ['user-1', 'user-2', 'user-3'];
        $loggedActorIds = [];

        $this->logger->expects($this->exactly(3))
            ->method('write')
            ->willReturnCallback(function ($level, $action, $message, $actorId, $data) use (&$loggedActorIds) {
                $loggedActorIds[] = $actorId;
            });

        foreach ($actorIds as $actorId) {
            $this->useCase->execute($request, $actorId);
        }

        $this->assertEquals($actorIds, $loggedActorIds);
    }
}
