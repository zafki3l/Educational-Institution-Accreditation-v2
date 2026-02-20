<?php

namespace Tests\Feature\Modules\UserManagement\Application\UseCases;

use App\Modules\Authentication\Domain\ValueObjects\AuthId;
use App\Modules\UserManagement\Application\UseCases\DeleteUserUseCase;
use App\Modules\UserManagement\Domain\Entities\User;
use App\Modules\UserManagement\Domain\Repositories\UserRepositoryInterface;
use App\Modules\UserManagement\Domain\ValueObjects\Email;
use App\Modules\UserManagement\Domain\ValueObjects\Password;
use App\Modules\UserManagement\Domain\ValueObjects\UserId;
use App\Shared\Logging\LoggerInterface;
use PHPUnit\Framework\TestCase;

class DeleteUserUseCaseTest extends TestCase
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
            Email::fromString('john.doe@example.com'),
            Password::fromPlain('password123'),
            1
        );
    }

    /**
     * Test that execute deletes a user successfully
     */
    public function testExecuteDeletesUserSuccessfully(): void
    {
        $repository = $this->createMock(UserRepositoryInterface::class);
        $repository->expects($this->once())
            ->method('findOrFail')
            ->with($this->userId->value())
            ->willReturn($this->mockUser);

        $repository->expects($this->once())
            ->method('delete')
            ->with($this->userId->value());

        $logger = $this->createMock(LoggerInterface::class);
        $logger->expects($this->once())
            ->method('write');

        $useCase = new DeleteUserUseCase($repository, $logger);
        $useCase->execute($this->userId->value(), 'admin-123');
    }

    /**
     * Test that execute calls findOrFail with the correct user ID
     */
    public function testExecuteCallsRepositoryFindOrFailWithUserId(): void
    {
        $userId = 'specific-user-id-456';

        $repository = $this->createMock(UserRepositoryInterface::class);
        $repository->expects($this->once())
            ->method('findOrFail')
            ->with($userId)
            ->willReturn($this->mockUser);

        $repository->expects($this->once())
            ->method('delete')
            ->with($userId);

        $logger = $this->createMock(LoggerInterface::class);
        $logger->method('write');

        $useCase = new DeleteUserUseCase($repository, $logger);
        $useCase->execute($userId, 'admin-user');
    }

    /**
     * Test that execute calls delete with the correct user ID
     */
    public function testExecuteCallsRepositoryDeleteWithUserId(): void
    {
        $userId = 'user-to-delete-789';

        $repository = $this->createMock(UserRepositoryInterface::class);
        $repository->method('findOrFail')
            ->with($userId)
            ->willReturn($this->mockUser);

        $repository->expects($this->once())
            ->method('delete')
            ->with($userId);

        $logger = $this->createMock(LoggerInterface::class);
        $logger->method('write');

        $useCase = new DeleteUserUseCase($repository, $logger);
        $useCase->execute($userId, 'actor-id');
    }

    /**
     * Test that logger.write is called with correct parameters
     */
    public function testExecuteLogsWithCorrectParameters(): void
    {
        $actorId = 'admin-user-123';

        $repository = $this->createMock(UserRepositoryInterface::class);
        $repository->method('findOrFail')
            ->willReturn($this->mockUser);

        $repository->method('delete');

        $logger = $this->createMock(LoggerInterface::class);
        $logger->expects($this->once())
            ->method('write')
            ->with(
                'info',
                'delete',
                $this->stringContains($actorId),
                $actorId,
            );

        $useCase = new DeleteUserUseCase($repository, $logger);
        $useCase->execute($this->userId->value(), $actorId);
    }

    /**
     * Test that logger receives the deleted user's information
     */
    public function testExecuteLogsUserInformation(): void
    {
        $firstName = 'Jane';
        $lastName = 'Smith';
        $email = 'jane.smith@example.com';
        $roleId = 2;

        $user = User::create(
            $this->userId,
            AuthId::generate(),
            $firstName,
            $lastName,
            Email::fromString($email),
            Password::fromPlain('password123'),
            $roleId
        );

        $repository = $this->createMock(UserRepositoryInterface::class);
        $repository->method('findOrFail')
            ->willReturn($user);

        $repository->method('delete');

        $logger = $this->createMock(LoggerInterface::class);
        $logger->expects($this->once())
            ->method('write')
            ->with(
                'info',
                'delete',
                $this->anything(),
                $this->anything(),
                $this->callback(function (array $logData) use ($firstName, $lastName, $email, $roleId) {
                    return $logData['first_name'] === $firstName &&
                           $logData['last_name'] === $lastName &&
                           $logData['email'] === $email &&
                           $logData['role_id'] === $roleId;
                })
            );

        $useCase = new DeleteUserUseCase($repository, $logger);
        $useCase->execute($this->userId->value(), 'admin');
    }

    /**
     * Test that execute logs with correct actor ID
     */
    public function testExecuteLogsWithCorrectActorId(): void
    {
        $specificActorId = 'specific-actor-456';

        $repository = $this->createMock(UserRepositoryInterface::class);
        $repository->method('findOrFail')
            ->willReturn($this->mockUser);

        $repository->method('delete');

        $logger = $this->createMock(LoggerInterface::class);
        $logger->expects($this->once())
            ->method('write')
            ->with(
                $this->anything(),
                $this->anything(),
                $this->anything(),
                $specificActorId,
                $this->anything()
            );

        $useCase = new DeleteUserUseCase($repository, $logger);
        $useCase->execute($this->userId->value(), $specificActorId);
    }

    /**
     * Test that logger includes user ID in logged data
     */
    public function testExecuteLogsIncludeUserId(): void
    {
        $repository = $this->createMock(UserRepositoryInterface::class);
        $repository->method('findOrFail')
            ->willReturn($this->mockUser);

        $repository->method('delete');

        $logger = $this->createMock(LoggerInterface::class);
        $logger->expects($this->once())
            ->method('write')
            ->with(
                $this->anything(),
                $this->anything(),
                $this->anything(),
                $this->anything(),
                $this->callback(function (array $logData) {
                    return isset($logData['id']) && $logData['id'] === $this->userId->value();
                })
            );

        $useCase = new DeleteUserUseCase($repository, $logger);
        $useCase->execute($this->userId->value(), 'admin');
    }

    /**
     * Test that repository delete is called after finding user
     */
    public function testRepositoryDeleteIsCalledAfterFinding(): void
    {
        $callOrder = [];

        $repository = $this->createMock(UserRepositoryInterface::class);
        $repository->expects($this->once())
            ->method('findOrFail')
            ->willReturnCallback(function () use (&$callOrder) {
                $callOrder[] = 'find';
                return $this->mockUser;
            });

        $repository->expects($this->once())
            ->method('delete')
            ->willReturnCallback(function () use (&$callOrder) {
                $callOrder[] = 'delete';
            });

        $logger = $this->createMock(LoggerInterface::class);
        $logger->method('write');

        $useCase = new DeleteUserUseCase($repository, $logger);
        $useCase->execute($this->userId->value(), 'admin');

        $this->assertEquals(['find', 'delete'], $callOrder);
    }

    /**
     * Test with a user that has no email
     */
    public function testExecuteWithUserWithoutEmail(): void
    {
        $userWithoutEmail = User::create(
            $this->userId,
            AuthId::generate(),
            'Test',
            'User',
            null,
            Password::fromPlain('password123'),
            1
        );

        $repository = $this->createMock(UserRepositoryInterface::class);
        $repository->method('findOrFail')
            ->willReturn($userWithoutEmail);

        $repository->expects($this->once())
            ->method('delete');

        $logger = $this->createMock(LoggerInterface::class);
        $logger->expects($this->once())
            ->method('write')
            ->with(
                $this->anything(),
                $this->anything(),
                $this->anything(),
                $this->anything(),
                $this->callback(function (array $logData) {
                    return $logData['email'] === null;
                })
            );

        $useCase = new DeleteUserUseCase($repository, $logger);
        $useCase->execute($this->userId->value(), 'admin');
    }

    /**
     * Test with different role IDs
     */
    public function testExecuteWithDifferentRoleIds(): void
    {
        $roleIds = [1, 2, 3, 5];

        foreach ($roleIds as $roleId) {
            $user = User::create(
                UserId::generate(),
                AuthId::generate(),
                'User',
                'Test',
                Email::fromString('user@example.com'),
                Password::fromPlain('password123'),
                $roleId
            );

            $repository = $this->createMock(UserRepositoryInterface::class);
            $repository->method('findOrFail')
                ->willReturn($user);

            $repository->method('delete');

            $logger = $this->createMock(LoggerInterface::class);
            $logger->expects($this->once())
                ->method('write')
                ->with(
                    $this->anything(),
                    $this->anything(),
                    $this->anything(),
                    $this->anything(),
                    $this->callback(function (array $logData) use ($roleId) {
                        return $logData['role_id'] === $roleId;
                    })
                );

            $useCase = new DeleteUserUseCase($repository, $logger);
            $useCase->execute($user->getUserId()->value(), 'admin');
        }
    }

    /**
     * Test log message includes actor ID
     */
    public function testDeleteLogMessageIncludesActorId(): void
    {
        $actorId = 'actor-789';

        $repository = $this->createMock(UserRepositoryInterface::class);
        $repository->method('findOrFail')
            ->willReturn($this->mockUser);

        $repository->method('delete');

        $logger = $this->createMock(LoggerInterface::class);
        $logger->expects($this->once())
            ->method('write')
            ->with(
                'info',
                'delete',
                $this->stringContains($actorId),
                $this->anything(),
                $this->anything()
            );

        $useCase = new DeleteUserUseCase($repository, $logger);
        $useCase->execute($this->userId->value(), $actorId);
    }

    /**
     * Test log message includes deleted user ID
     */
    public function testDeleteLogMessageIncludesDeletedUserId(): void
    {
        $repository = $this->createMock(UserRepositoryInterface::class);
        $repository->method('findOrFail')
            ->willReturn($this->mockUser);

        $repository->method('delete');

        $logger = $this->createMock(LoggerInterface::class);
        $logger->expects($this->once())
            ->method('write')
            ->with(
                'info',
                'delete',
                $this->stringContains($this->userId->value()),
                $this->anything(),
                $this->anything()
            );

        $useCase = new DeleteUserUseCase($repository, $logger);
        $useCase->execute($this->userId->value(), 'admin');
    }

    /**
     * Test that writeLog method is called correctly
     */
    public function testWriteLogMethodUsesCorrectUserData(): void
    {
        $firstName = 'Alice';
        $lastName = 'Johnson';
        $email = 'alice@example.com';

        $user = User::create(
            $this->userId,
            AuthId::generate(),
            $firstName,
            $lastName,
            Email::fromString($email),
            Password::fromPlain('password123'),
            3
        );

        $repository = $this->createMock(UserRepositoryInterface::class);
        $repository->method('findOrFail')
            ->willReturn($user);

        $repository->method('delete');

        $logger = $this->createMock(LoggerInterface::class);
        $logger->expects($this->once())
            ->method('write')
            ->with(
                'info',
                'delete',
                $this->anything(),
                $this->anything(),
                $this->callback(function (array $logData) use ($firstName, $lastName, $email) {
                    return $logData['first_name'] === $firstName &&
                           $logData['last_name'] === $lastName &&
                           $logData['email'] === $email;
                })
            );

        $useCase = new DeleteUserUseCase($repository, $logger);
        $useCase->execute($this->userId->value(), 'super-admin');
    }
}
