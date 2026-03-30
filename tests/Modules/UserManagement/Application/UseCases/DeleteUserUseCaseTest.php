<?php

namespace Tests\Unit\Modules\UserManagement\Application\UseCases;

use App\Modules\UserManagement\Application\UseCases\DeleteUserUseCase;
use App\Modules\UserManagement\Domain\Entities\User;
use App\Modules\UserManagement\Domain\Repositories\UserRepositoryInterface;
use App\Modules\UserManagement\Domain\ValueObjects\UserId;
use App\Shared\Contracts\Events\EventDispatcherInterface;
use App\Shared\Contracts\UnitOfWork\UnitOfWorkInterface;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;
use Tests\TraitHelper\DebugHelper;

class DeleteUserUseCaseTest extends TestCase
{
    use DebugHelper;

    private UserRepositoryInterface&MockObject $repository;
    private EventDispatcherInterface&MockObject $eventDispatcher;
    private UnitOfWorkInterface&MockObject $unitOfWork;
    private DeleteUserUseCase $useCase;

    protected function setUp(): void
    {
        $this->repository = $this->createMock(UserRepositoryInterface::class);
        $this->eventDispatcher = $this->createMock(EventDispatcherInterface::class);
        $this->unitOfWork = $this->createMock(UnitOfWorkInterface::class);

        $this->unitOfWork->method('execute')->willReturnCallback(function ($callback) {
            return $callback();
        });

        $this->useCase = new DeleteUserUseCase(
            $this->repository,
            $this->eventDispatcher,
            $this->unitOfWork
        );
    }

    public function testDeleteUserSuccessfully(): void
    {
        $userIdStr = 'f47ac10b-58cc-4372-a567-0e02b2c3d479';
        $actorId = 'actor-123';

        $user = $this->createMock(User::class);
        $user->method('getUserId')->willReturn(UserId::fromString($userIdStr));

        $this->repository->expects($this->once())
            ->method('findOrFail')
            ->with($userIdStr)
            ->willReturn($user);

        $this->repository->expects($this->once())
            ->method('delete')
            ->with($userIdStr);

        $this->eventDispatcher->expects($this->once())
            ->method('dispatch');

        $this->useCase->execute($userIdStr, $actorId);

        $this->debug('DELETE SUCCESS', ['user_id' => $userIdStr]);
    }

    public function testDeleteUserFailsWhenUserNotFound(): void
    {
        $invalidId = 'non-existent-id';
        
        $this->repository->method('findOrFail')
            ->with($invalidId)
            ->willThrowException(new \Exception("User not found"));

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage("User not found");

        $this->unitOfWork->expects($this->never())->method('execute');
        $this->repository->expects($this->never())->method('delete');
        $this->eventDispatcher->expects($this->never())->method('dispatch');

        $this->useCase->execute($invalidId, 'actor-123');
    }
}