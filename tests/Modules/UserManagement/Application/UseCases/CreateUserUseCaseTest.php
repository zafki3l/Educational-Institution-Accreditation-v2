<?php

namespace Tests\Unit\Modules\UserManagement\Application\UseCases;

use App\Modules\UserManagement\Application\Requests\CreateUserRequestInterface;
use App\Modules\UserManagement\Application\UseCases\CreateUserUseCase;
use App\Modules\UserManagement\Domain\Entities\User;
use App\Modules\UserManagement\Domain\Exception\EmailExistException;
use App\Modules\UserManagement\Domain\Repositories\UserRepositoryInterface;
use App\Modules\UserManagement\Domain\Services\EmailExistsCheckerInterface;
use App\Shared\Contracts\Events\EventDispatcherInterface;
use App\Shared\Contracts\UnitOfWork\UnitOfWorkInterface;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;
use Tests\TraitHelper\DebugHelper;

class CreateUserUseCaseTest extends TestCase
{
    use DebugHelper;

    private UserRepositoryInterface&MockObject $userRepository;
    private EmailExistsCheckerInterface&MockObject $emailChecker;
    private EventDispatcherInterface&MockObject $eventDispatcher;
    private UnitOfWorkInterface&MockObject $unitOfWork;
    private CreateUserUseCase $useCase;

    protected function setUp(): void
    {
        $this->userRepository = $this->createMock(UserRepositoryInterface::class);
        $this->emailChecker = $this->createMock(EmailExistsCheckerInterface::class);
        $this->eventDispatcher = $this->createMock(EventDispatcherInterface::class);
        $this->unitOfWork = $this->createMock(UnitOfWorkInterface::class);

        $this->unitOfWork->method('execute')->willReturnCallback(function ($callback) {
            return $callback();
        });

        $this->useCase = new CreateUserUseCase(
            $this->userRepository,
            $this->emailChecker,
            $this->eventDispatcher,
            $this->unitOfWork
        );
    }

    public function testCreateUserSuccessfully(): void
    {
        $request = $this->createMock(CreateUserRequestInterface::class);
        $request->method('getEmail')->willReturn('anh.nguyen@example.com');
        $request->method('getFirstName')->willReturn('Anh');
        $request->method('getLastName')->willReturn('Nguyen');
        $request->method('getPassword')->willReturn('SecurePass123');
        $request->method('getRoleId')->willReturn(1);
        
        $request->method('getDepartmentId')->willReturn('101'); 

        $this->emailChecker->method('isExists')->willReturn(false);

        $this->userRepository->expects($this->once())
            ->method('create')
            ->with($this->isInstanceOf(User::class));

        $this->eventDispatcher->expects($this->once())
            ->method('dispatch');

        $this->useCase->execute($request, 'actor-uuid-123');
        
        $this->debug('TEST SUCCESS', ['status' => 'User created and event dispatched']);
    }

    public function testCreateUserThrowsExceptionWhenEmailExists(): void
    {
        $request = $this->createMock(CreateUserRequestInterface::class);
        $request->method('getEmail')->willReturn('existing@example.com');

        $this->emailChecker->method('isExists')->willReturn(true);

        $this->expectException(EmailExistException::class);
        
        $this->userRepository->expects($this->never())->method('create');
        $this->eventDispatcher->expects($this->never())->method('dispatch');

        $this->useCase->execute($request, 'actor-uuid-123');
    }
}