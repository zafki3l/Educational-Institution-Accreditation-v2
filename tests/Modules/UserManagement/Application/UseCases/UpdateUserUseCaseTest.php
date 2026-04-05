<?php

namespace Tests\Unit\Modules\UserManagement\Application\UseCases;

use App\Modules\UserManagement\Application\Requests\UpdateUserRequestInterface;
use App\Modules\UserManagement\Application\UseCases\UpdateUserUseCase;
use App\Modules\UserManagement\Domain\Entities\User;
use App\Modules\UserManagement\Domain\Repositories\UserRepositoryInterface;
use App\Modules\UserManagement\Domain\ValueObjects\Email;
use App\Modules\UserManagement\Domain\ValueObjects\UserId;
use App\Shared\Contracts\Events\EventDispatcherInterface;
use App\Shared\Contracts\UnitOfWork\UnitOfWorkInterface;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;
use Tests\TraitHelper\DebugHelper;

class UpdateUserUseCaseTest extends TestCase
{
    use DebugHelper;

    private UserRepositoryInterface&MockObject $repository;
    private EventDispatcherInterface&MockObject $eventDispatcher;
    private UnitOfWorkInterface&MockObject $unitOfWork;
    private UpdateUserUseCase $useCase;

    protected function setUp(): void
    {
        $this->repository = $this->createMock(UserRepositoryInterface::class);
        $this->eventDispatcher = $this->createMock(EventDispatcherInterface::class);
        $this->unitOfWork = $this->createMock(UnitOfWorkInterface::class);

        $this->unitOfWork->method('execute')->willReturnCallback(function ($callback) {
            return $callback();
        });

        $this->useCase = new UpdateUserUseCase(
            $this->repository,
            $this->eventDispatcher,
            $this->unitOfWork
        );
    }

    public function testUpdateUserSuccessfully(): void
    {
        $userId = '550e8400-e29b-41d4-a716-446655440000'; 
        $actorId = 'f47ac10b-58cc-4372-a567-0e02b2c3d479';

        $request = $this->createMock(UpdateUserRequestInterface::class);
        $request->method('getId')->willReturn($userId);
        $request->method('getFirstName')->willReturn('Tran');
        $request->method('getLastName')->willReturn('B');
        $request->method('getEmail')->willReturn('tranb@example.com');
        $request->method('getRoleId')->willReturn(2);
        $request->method('getDepartmentId')->willReturn('dept-002');

        $user = $this->createMock(User::class);
        $user->method('getUserId')->willReturn(UserId::fromString($userId));
        $user->method('getChanges')->willReturn(['first_name' => 'Tran']);

        $this->repository->expects($this->once())
            ->method('findOrFail')
            ->with($userId)
            ->willReturn($user);

        $user->expects($this->once())
            ->method('update')
            ->with(
                'Tran',
                'B',
                $this->isInstanceOf(Email::class),
                2,
                'dept-002'
            );

        $this->repository->expects($this->once())->method('update')->with($user);
        $this->eventDispatcher->expects($this->once())->method('dispatch');

        $this->useCase->execute($request, $actorId);
        
        $this->debug('UPDATE SUCCESS', ['user' => $userId]);
    }

    public function testUpdateConvertsEmptyDepartmentToNull(): void
    {
        $validUuid = '550e8400-e29b-41d4-a716-446655440000';

        $request = $this->createMock(UpdateUserRequestInterface::class);
        $request->method('getId')->willReturn('uuid-123');
        $request->method('getEmail')->willReturn('valid@email.com');
        $request->method('getDepartmentId')->willReturn('');

        $user = $this->createMock(User::class);
        $user->method('getUserId')->willReturn(UserId::fromString($validUuid));
        
        $this->repository->method('findOrFail')->willReturn($user);

        $user->expects($this->once())
            ->method('update')
            ->with(
                $this->anything(),
                $this->anything(),
                $this->anything(),
                $this->anything(),
                $this->isNull()
            );

        $this->useCase->execute($request, 'actor-123');
    }
}