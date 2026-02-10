<?php

namespace Tests\Feature\Modules\UserManagement\Application\UseCases;

use App\Modules\UserManagement\Application\Requests\CreateUserRequestInterface;
use App\Modules\UserManagement\Application\UseCases\CreateUserUseCase;
use App\Modules\UserManagement\Domain\Entities\User;
use App\Modules\UserManagement\Domain\Repositories\UserRepositoryInterface;
use App\Shared\Logging\LoggerInterface;
use PHPUnit\Framework\TestCase;

class CreateUserUseCaseTest extends TestCase
{
    public function testExecuteCreatesUserSuccessfully(): void
    {
        $request = $this->createMock(CreateUserRequestInterface::class);
        $request->method('getFirstName')->willReturn('John');
        $request->method('getLastName')->willReturn('Doe');
        $request->method('getPassword')->willReturn('password123');
        $request->method('getRoleId')->willReturn('1');
        $request->method('getEmail')->willReturn('john@example.com');

        $repository = $this->createMock(UserRepositoryInterface::class);
        $repository->expects($this->once())
            ->method('create')
            ->with($this->isInstanceOf(User::class))
            ->willReturnCallback(function (User $user) {
                return $user;
            });

        $logger = $this->createMock(LoggerInterface::class);
        $logger->expects($this->once())
            ->method('write')
            ->with(
                'info',
                'update',
                $this->stringContains('thêm một người dùng mới'),
                'actor-123'
            );

        $useCase = new CreateUserUseCase($repository, $logger);
        $useCase->execute($request, 'actor-123');
    }

    public function testExecuteWithDifferentRoleId(): void
    {
        $request = $this->createMock(CreateUserRequestInterface::class);
        $request->method('getFirstName')->willReturn('Jane');
        $request->method('getLastName')->willReturn('Smith');
        $request->method('getPassword')->willReturn('securepass');
        $request->method('getRoleId')->willReturn('2');
        $request->method('getEmail')->willReturn('jane@example.com');

        $repository = $this->createMock(UserRepositoryInterface::class);
        $capturedException = null;
        $repository->expects($this->once())
            ->method('create')
            ->with($this->isInstanceOf(User::class))
            ->willReturnCallback(function (User $user) use (&$capturedException) {
                // Verify that the user was created with the correct role ID
                $this->assertEquals(2, $user->getRoleId());
                return $user;
            });

        $logger = $this->createMock(LoggerInterface::class);
        $logger->method('write');

        $useCase = new CreateUserUseCase($repository, $logger);
        $useCase->execute($request, 'admin-user');
    }

    public function testExecuteCallsRepositoryCreateExactlyOnce(): void
    {
        $request = $this->createMock(CreateUserRequestInterface::class);
        $request->method('getFirstName')->willReturn('Test');
        $request->method('getLastName')->willReturn('User');
        $request->method('getPassword')->willReturn('test123');
        $request->method('getRoleId')->willReturn('1');
        $request->method('getEmail')->willReturn('test@example.com');

        $repository = $this->createMock(UserRepositoryInterface::class);
        $repository->expects($this->once())
            ->method('create')
            ->with($this->isInstanceOf(User::class))
            ->willReturnCallback(function (User $user) {
                return $user;
            });

        $logger = $this->createMock(LoggerInterface::class);
        $logger->method('write');

        $useCase = new CreateUserUseCase($repository, $logger);
        $useCase->execute($request, 'actor-id');
    }

    public function testExecuteLogsWithCorrectActorId(): void
    {
        $request = $this->createMock(CreateUserRequestInterface::class);
        $request->method('getFirstName')->willReturn('Log');
        $request->method('getLastName')->willReturn('Test');
        $request->method('getPassword')->willReturn('pass123');
        $request->method('getRoleId')->willReturn('1');
        $request->method('getEmail')->willReturn('log@example.com');

        $repository = $this->createMock(UserRepositoryInterface::class);
        $repository->method('create')
            ->with($this->isInstanceOf(User::class))
            ->willReturnCallback(function (User $user) {
                return $user;
            });

        $logger = $this->createMock(LoggerInterface::class);
        $logger->expects($this->once())
            ->method('write')
            ->with(
                $this->anything(),
                $this->anything(),
                $this->anything(),
                'specific-actor-123'
            );

        $useCase = new CreateUserUseCase($repository, $logger);
        $useCase->execute($request, 'specific-actor-123');
    }

    public function testExecuteLogsUserInformation(): void
    {
        $firstName = 'John';
        $lastName = 'Developer';
        $roleId = '2';

        $request = $this->createMock(CreateUserRequestInterface::class);
        $request->method('getFirstName')->willReturn($firstName);
        $request->method('getLastName')->willReturn($lastName);
        $request->method('getPassword')->willReturn('pass123');
        $request->method('getRoleId')->willReturn($roleId);
        $request->method('getEmail')->willReturn('john@example.com');

        $repository = $this->createMock(UserRepositoryInterface::class);
        $repository->method('create')
            ->with($this->isInstanceOf(User::class))
            ->willReturnCallback(function (User $user) {
                return $user;
            });

        $logger = $this->createMock(LoggerInterface::class);
        $logger->expects($this->once())
            ->method('write')
            ->with(
                'info',
                'update',
                $this->stringContains('thêm một người dùng mới'),
                $this->anything(),
                $this->callback(function ($logData) use ($firstName, $lastName) {
                    return isset($logData['first_name']) && $logData['first_name'] === $firstName
                        && isset($logData['last_name']) && $logData['last_name'] === $lastName;
                })
            );

        $useCase = new CreateUserUseCase($repository, $logger);
        $useCase->execute($request, 'actor-123');
    }

    public function testExecuteWithSpecialCharactersInName(): void
    {
        $request = $this->createMock(CreateUserRequestInterface::class);
        $request->method('getFirstName')->willReturn('José');
        $request->method('getLastName')->willReturn("O'Brien");
        $request->method('getPassword')->willReturn('pass123');
        $request->method('getRoleId')->willReturn('1');
        $request->method('getEmail')->willReturn('jose@example.com');

        $repository = $this->createMock(UserRepositoryInterface::class);
        $repository->method('create')
            ->with($this->isInstanceOf(User::class))
            ->willReturnCallback(function (User $user) {
                $this->assertEquals('José', $user->getFirstName());
                $this->assertEquals("O'Brien", $user->getLastName());
                return $user;
            });

        $logger = $this->createMock(LoggerInterface::class);
        $logger->method('write');

        $useCase = new CreateUserUseCase($repository, $logger);
        $useCase->execute($request, 'actor-123');
    }
}
