<?php

namespace Tests\Feature\Modules\UserManagement\Application\UseCases;

use App\Modules\Authentication\Domain\ValueObjects\AuthId;
use App\Modules\UserManagement\Application\Requests\UpdateUserRequestInterface;
use App\Modules\UserManagement\Application\UseCases\UpdateUserUseCase;
use App\Modules\UserManagement\Domain\Entities\User;
use App\Modules\UserManagement\Domain\Repositories\UserRepositoryInterface;
use App\Modules\UserManagement\Domain\ValueObjects\Password;
use App\Modules\UserManagement\Domain\ValueObjects\UserId;
use App\Shared\Logging\LoggerInterface;
use PHPUnit\Framework\TestCase;

class UpdateUserUseCaseTest extends TestCase
{
    private UserId $userId;
    private User $mockUser;

    protected function setUp(): void
    {
        $this->userId = UserId::generate();
        $this->mockUser = User::create(
            $this->userId,
            AuthId::generate(),
            'John',
            'Doe',
            Password::fromPlain('oldpass'),
            1
        );
    }

    public function testExecuteUpdatesUserSuccessfully(): void
    {
        $request = $this->createMock(UpdateUserRequestInterface::class);
        $request->method('getId')->willReturn($this->userId->value());
        $request->method('getFirstName')->willReturn('Jane');
        $request->method('getLastName')->willReturn('Smith');
        $request->method('getEmail')->willReturn('jane@example.com');
        $request->method('getRoleId')->willReturn('2');

        $repository = $this->createMock(UserRepositoryInterface::class);
        $repository->expects($this->once())
            ->method('findOrFail')
            ->with($this->userId->value())
            ->willReturn($this->mockUser);

        $repository->expects($this->once())
            ->method('save')
            ->with($this->mockUser);

        $logger = $this->createMock(LoggerInterface::class);
        $logger->expects($this->once())
            ->method('write');

        $useCase = new UpdateUserUseCase($repository, $logger);
        $useCase->execute($request, 'admin-123');
    }

    public function testExecuteCallsRepositoryFindOrFailWithUserId(): void
    {
        $userId = 'some-user-id-123';

        $request = $this->createMock(UpdateUserRequestInterface::class);
        $request->method('getId')->willReturn($userId);
        $request->method('getFirstName')->willReturn('John');
        $request->method('getLastName')->willReturn('Doe');
        $request->method('getEmail')->willReturn('');
        $request->method('getRoleId')->willReturn('1');

        $repository = $this->createMock(UserRepositoryInterface::class);
        $repository->expects($this->once())
            ->method('findOrFail')
            ->with($userId)
            ->willReturn($this->mockUser);

        $repository->expects($this->once())
            ->method('save');

        $logger = $this->createMock(LoggerInterface::class);
        $logger->method('write');

        $useCase = new UpdateUserUseCase($repository, $logger);
        $useCase->execute($request, 'admin');
    }

    public function testExecuteCallsRepositorySaveWithUpdatedUser(): void
    {
        $request = $this->createMock(UpdateUserRequestInterface::class);
        $request->method('getId')->willReturn($this->userId->value());
        $request->method('getFirstName')->willReturn('Jane');
        $request->method('getLastName')->willReturn('Smith');
        $request->method('getEmail')->willReturn('jane@example.com');
        $request->method('getRoleId')->willReturn('3');

        $repository = $this->createMock(UserRepositoryInterface::class);
        $repository->method('findOrFail')
            ->willReturn($this->mockUser);

        $repository->expects($this->once())
            ->method('save')
            ->with($this->callback(function (User $user) {
                return $user->getFirstName() === 'Jane'
                    && $user->getLastName() === 'Smith'
                    && $user->getRoleId() === 3;
            }));

        $logger = $this->createMock(LoggerInterface::class);
        $logger->method('write');

        $useCase = new UpdateUserUseCase($repository, $logger);
        $useCase->execute($request, 'admin');
    }

    public function testExecuteUpdatesFirstNameAndLastName(): void
    {
        $request = $this->createMock(UpdateUserRequestInterface::class);
        $request->method('getId')->willReturn($this->userId->value());
        $request->method('getFirstName')->willReturn('Alice');
        $request->method('getLastName')->willReturn('Johnson');
        $request->method('getEmail')->willReturn('');
        $request->method('getRoleId')->willReturn('1');

        $repository = $this->createMock(UserRepositoryInterface::class);
        $repository->method('findOrFail')
            ->willReturn($this->mockUser);

        $repository->expects($this->once())
            ->method('save')
            ->with($this->callback(function (User $user) {
                return $user->getFirstName() === 'Alice'
                    && $user->getLastName() === 'Johnson';
            }));

        $logger = $this->createMock(LoggerInterface::class);
        $logger->method('write');

        $useCase = new UpdateUserUseCase($repository, $logger);
        $useCase->execute($request, 'admin');
    }

    public function testExecuteUpdatesRoleId(): void
    {
        $request = $this->createMock(UpdateUserRequestInterface::class);
        $request->method('getId')->willReturn($this->userId->value());
        $request->method('getFirstName')->willReturn('John');
        $request->method('getLastName')->willReturn('Doe');
        $request->method('getEmail')->willReturn('');
        $request->method('getRoleId')->willReturn('5');

        $repository = $this->createMock(UserRepositoryInterface::class);
        $repository->method('findOrFail')
            ->willReturn($this->mockUser);

        $repository->expects($this->once())
            ->method('save')
            ->with($this->callback(function (User $user) {
                return $user->getRoleId() === 5;
            }));

        $logger = $this->createMock(LoggerInterface::class);
        $logger->method('write');

        $useCase = new UpdateUserUseCase($repository, $logger);
        $useCase->execute($request, 'admin');
    }

    public function testExecuteUpdatesEmailWhenProvided(): void
    {
        $request = $this->createMock(UpdateUserRequestInterface::class);
        $request->method('getId')->willReturn($this->userId->value());
        $request->method('getFirstName')->willReturn('John');
        $request->method('getLastName')->willReturn('Doe');
        $request->method('getEmail')->willReturn('newemail@example.com');
        $request->method('getRoleId')->willReturn('1');

        $repository = $this->createMock(UserRepositoryInterface::class);
        $repository->method('findOrFail')
            ->willReturn($this->mockUser);

        $repository->expects($this->once())
            ->method('save')
            ->with($this->callback(function (User $user) {
                return $user->getEmail() !== null
                    && $user->getEmail()->value() === 'newemail@example.com';
            }));

        $logger = $this->createMock(LoggerInterface::class);
        $logger->method('write');

        $useCase = new UpdateUserUseCase($repository, $logger);
        $useCase->execute($request, 'admin');
    }

    public function testExecuteDoesNotUpdateEmailWhenEmptyString(): void
    {
        $request = $this->createMock(UpdateUserRequestInterface::class);
        $request->method('getId')->willReturn($this->userId->value());
        $request->method('getFirstName')->willReturn('John');
        $request->method('getLastName')->willReturn('Doe');
        $request->method('getEmail')->willReturn('');
        $request->method('getRoleId')->willReturn('1');

        $repository = $this->createMock(UserRepositoryInterface::class);
        $repository->method('findOrFail')
            ->willReturn($this->mockUser);

        $repository->expects($this->once())
            ->method('save');

        $logger = $this->createMock(LoggerInterface::class);
        $logger->method('write');

        $useCase = new UpdateUserUseCase($repository, $logger);
        $useCase->execute($request, 'admin');
    }

    public function testExecuteLogsUpdateActivity(): void
    {
        $request = $this->createMock(UpdateUserRequestInterface::class);
        $request->method('getId')->willReturn($this->userId->value());
        $request->method('getFirstName')->willReturn('John');
        $request->method('getLastName')->willReturn('Doe');
        $request->method('getEmail')->willReturn('john@example.com');
        $request->method('getRoleId')->willReturn('2');

        $repository = $this->createMock(UserRepositoryInterface::class);
        $repository->method('findOrFail')
            ->willReturn($this->mockUser);

        $repository->method('save');

        $logger = $this->createMock(LoggerInterface::class);
        $logger->expects($this->once())
            ->method('write')
            ->with(
                'info',
                'update',
                $this->stringContains('cập nhật thông tin'),
                'admin-123'
            );

        $useCase = new UpdateUserUseCase($repository, $logger);
        $useCase->execute($request, 'admin-123');
    }

    public function testExecuteLogsWithCorrectUserData(): void
    {
        $request = $this->createMock(UpdateUserRequestInterface::class);
        $request->method('getId')->willReturn('user-id-456');
        $request->method('getFirstName')->willReturn('Bob');
        $request->method('getLastName')->willReturn('Builder');
        $request->method('getEmail')->willReturn('bob@example.com');
        $request->method('getRoleId')->willReturn('2');

        $repository = $this->createMock(UserRepositoryInterface::class);
        $repository->method('findOrFail')
            ->willReturn($this->mockUser);

        $repository->method('save');

        $logger = $this->createMock(LoggerInterface::class);
        $logger->expects($this->once())
            ->method('write')
            ->with(
                $this->anything(),
                $this->anything(),
                $this->anything(),
                $this->anything(),
                $this->callback(function ($logData) {
                    return isset($logData['first_name']) && $logData['first_name'] === 'Bob'
                        && isset($logData['last_name']) && $logData['last_name'] === 'Builder';
                })
            );

        $useCase = new UpdateUserUseCase($repository, $logger);
        $useCase->execute($request, 'admin');
    }

    public function testExecuteUpdatesAllFields(): void
    {
        $request = $this->createMock(UpdateUserRequestInterface::class);
        $request->method('getId')->willReturn($this->userId->value());
        $request->method('getFirstName')->willReturn('Sarah');
        $request->method('getLastName')->willReturn('Connor');
        $request->method('getEmail')->willReturn('sarah@example.com');
        $request->method('getRoleId')->willReturn('3');

        $repository = $this->createMock(UserRepositoryInterface::class);
        $repository->method('findOrFail')
            ->willReturn($this->mockUser);

        $repository->expects($this->once())
            ->method('save')
            ->with($this->callback(function (User $user) {
                return $user->getFirstName() === 'Sarah'
                    && $user->getLastName() === 'Connor'
                    && $user->getRoleId() === 3
                    && $user->getEmail() !== null
                    && $user->getEmail()->value() === 'sarah@example.com';
            }));

        $logger = $this->createMock(LoggerInterface::class);
        $logger->method('write');

        $useCase = new UpdateUserUseCase($repository, $logger);
        $useCase->execute($request, 'admin');
    }
}
