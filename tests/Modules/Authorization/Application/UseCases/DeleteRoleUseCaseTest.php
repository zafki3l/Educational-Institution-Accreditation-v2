<?php

namespace Tests\Modules\Authorization\Application\UseCases;

use App\Modules\Authorization\Application\UseCases\DeleteRoleUseCase;
use App\Modules\Authorization\Domain\Entities\Role;
use App\Modules\Authorization\Domain\Repositories\RoleRepositoryInterface;
use App\Shared\Contracts\Events\EventDispatcherInterface;
use App\Shared\Contracts\UnitOfWork\UnitOfWorkInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

final class DeleteRoleUseCaseTest extends TestCase
{
    private DeleteRoleUseCase $useCase;
    private RoleRepositoryInterface&MockObject $repositoryMock;
    private EventDispatcherInterface&MockObject $eventDispatcherMock;
    private UnitOfWorkInterface&MockObject $unitOfWorkMock;

    protected function setUp(): void
    {
        $this->repositoryMock = $this->createMock(RoleRepositoryInterface::class);
        $this->eventDispatcherMock = $this->createMock(EventDispatcherInterface::class);
        $this->unitOfWorkMock = $this->createMock(UnitOfWorkInterface::class);

        $this->unitOfWorkMock->method('execute')
            ->willReturnCallback(fn(callable $work) => $work());

        $this->useCase = new DeleteRoleUseCase(
            $this->repositoryMock, 
            $this->eventDispatcherMock,
            $this->unitOfWorkMock
        );
    }

    public function testDeleteRoleSuccess(): void
    {
        $roleId = 3;
        $actorId = 'admin_007';
        $roleName = 'Editor';

        $role = Role::create($roleName);
        $role->assignId($roleId);

        $this->repositoryMock->expects($this->once())
            ->method('findOrFail')
            ->with($roleId)
            ->willReturn($role);

        $this->repositoryMock->expects($this->once())
            ->method('delete')
            ->with($role);

        $this->eventDispatcherMock->expects($this->once())
            ->method('dispatch');

        $this->useCase->execute($roleId, $actorId);
    }

    public function testDeleteRoleFailsWhenNotFound(): void
    {
        $roleId = 999;
        
        $this->repositoryMock->method('findOrFail')
            ->willThrowException(new \Exception("Role not found"));

        $this->repositoryMock->expects($this->never())->method('delete');
        $this->eventDispatcherMock->expects($this->never())->method('dispatch');

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage("Role not found");
        
        $this->useCase->execute($roleId, 'actor_1');
    }
}