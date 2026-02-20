<?php

declare(strict_types=1);

namespace Tests\Feature\Modules\Authorization\Application\Role\UseCases;

use App\Modules\Authorization\Application\Role\UseCases\DeleteRoleUseCase;
use App\Modules\Authorization\Domain\Entities\Role;
use App\Modules\Authorization\Domain\Repositories\RoleRepositoryInterface;
use App\Shared\Logging\LoggerInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class DeleteRoleUseCaseTest extends TestCase
{
    private RoleRepositoryInterface|MockObject $roleRepository;
    private LoggerInterface|MockObject $logger;
    private DeleteRoleUseCase $useCase;

    protected function setUp(): void
    {
        $this->roleRepository = $this->createMock(RoleRepositoryInterface::class);
        $this->logger = $this->createMock(LoggerInterface::class);
        $this->useCase = new DeleteRoleUseCase($this->roleRepository, $this->logger);
    }

    public function testExecuteDeletesRoleSuccessfully(): void
    {
        $roleId = 1;
        $actorId = 'user-123';

        $role = Role::create('Administrator');
        $role->assignId($roleId);

        $this->roleRepository->expects($this->once())
            ->method('findOrFail')
            ->with($roleId)
            ->willReturn($role);

        $this->roleRepository->expects($this->once())
            ->method('delete')
            ->with($role);

        $this->logger->expects($this->once())
            ->method('write')
            ->with(
                'info',
                'delete',
                $this->stringContains((string)$roleId),
                $actorId,
                $this->callback(function ($data) use ($roleId) {
                    return isset($data['id']) && $data['id'] === $roleId;
                })
            );

        $this->useCase->execute($roleId, $actorId);
    }

    public function testExecuteCallsRepositoryFindOrFail(): void
    {
        $roleId = 2;

        $role = Role::create('Manager');
        $role->assignId($roleId);

        $this->roleRepository->expects($this->once())
            ->method('findOrFail')
            ->with($roleId)
            ->willReturn($role);

        $this->roleRepository->method('delete');
        $this->logger->method('write');

        $this->useCase->execute($roleId, 'user-id');
    }

    public function testExecuteCallsRepositoryDelete(): void
    {
        $roleId = 3;

        $role = Role::create('Editor');
        $role->assignId($roleId);

        $this->roleRepository->method('findOrFail')
            ->willReturn($role);

        $this->roleRepository->expects($this->once())
            ->method('delete')
            ->with($role);

        $this->logger->method('write');

        $this->useCase->execute($roleId, 'admin-id');
    }

    public function testExecuteCallsLoggerWriteMethod(): void
    {
        $roleId = 4;

        $role = Role::create('Viewer');
        $role->assignId($roleId);

        $this->roleRepository->method('findOrFail')
            ->willReturn($role);

        $this->roleRepository->method('delete');

        $this->logger->expects($this->once())
            ->method('write');

        $this->useCase->execute($roleId, 'user-id');
    }

    public function testExecutePassesCorrectRoleIdToLogger(): void
    {
        $roleId = 5;
        $actorId = 'specific-user-789';

        $role = Role::create('Contributor');
        $role->assignId($roleId);

        $this->roleRepository->method('findOrFail')
            ->willReturn($role);

        $this->roleRepository->method('delete');

        $this->logger->expects($this->once())
            ->method('write')
            ->with(
                $this->anything(),
                $this->anything(),
                $this->anything(),
                $this->anything(),
                $this->callback(function ($data) use ($roleId) {
                    return isset($data['id']) && $data['id'] === $roleId;
                })
            );

        $this->useCase->execute($roleId, $actorId);
    }

    public function testExecutePassesCorrectActorIdToLogger(): void
    {
        $roleId = 6;
        $actorId = 'specific-actor-456';

        $role = Role::create('Test Role');
        $role->assignId($roleId);

        $this->roleRepository->method('findOrFail')
            ->willReturn($role);

        $this->roleRepository->method('delete');

        $this->logger->expects($this->once())
            ->method('write')
            ->with(
                $this->anything(),
                $this->anything(),
                $this->anything(),
                $actorId,
                $this->anything()
            );

        $this->useCase->execute($roleId, $actorId);
    }

    public function testExecuteLogsDeleteAction(): void
    {
        $roleId = 7;

        $role = Role::create('Test');
        $role->assignId($roleId);

        $this->roleRepository->method('findOrFail')
            ->willReturn($role);

        $this->roleRepository->method('delete');

        $this->logger->expects($this->once())
            ->method('write')
            ->with('info', 'delete');

        $this->useCase->execute($roleId, 'user-id');
    }

    public function testExecuteLogsCorrectMessage(): void
    {
        $roleId = 100;
        $actorId = 'super-admin';

        $role = Role::create('Super Admin Role');
        $role->assignId($roleId);

        $this->roleRepository->method('findOrFail')
            ->willReturn($role);

        $this->roleRepository->method('delete');

        $this->logger->expects($this->once())
            ->method('write')
            ->with(
                'info',
                'delete',
                $this->stringContains('xóa'),
                $actorId,
                $this->anything()
            );

        $this->useCase->execute($roleId, $actorId);
    }
}
