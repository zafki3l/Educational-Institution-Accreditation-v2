<?php

namespace Tests\Feature\Modules\Authentication\Application\UseCases;

use App\Modules\Authentication\Application\Requests\LoginRequestInterface;
use App\Modules\Authentication\Application\UseCases\LoginUseCase;
use App\Modules\Authentication\Domain\Entities\AuthenticableUser;
use App\Modules\Authentication\Domain\Repositories\AuthenticableUserRepositoryInterface;
use App\Modules\UserManagement\Domain\ValueObjects\Password;
use PHPUnit\Framework\TestCase;

class LoginUseCaseTest extends TestCase
{
    public function testLoginSucess(): void
    {
        $request = $this->createMock(LoginRequestInterface::class);
        
        $request->method('getAuthId')->willReturn('123123123');
        
        $request->method('getPassword')->willReturn('123456');

        $repository = $this->createMock(AuthenticableUserRepositoryInterface::class);

        $password = $this->createMock(Password::class);
        
        $password->method('verify')->willReturn(true);

        $user = $this->createMock(AuthenticableUser::class);
        
        $user->method('getPassword')->willReturn($password);

        $repository->method('findByAuthId')->willReturn($user);

        $useCase = new LoginUseCase($repository);

        $response = $useCase->execute($request);

        $this->assertNotNull($response);
    }

    public function testLoginWithAuthIdWrong(): void
    {
        $request = $this->createMock(LoginRequestInterface::class);
        
        $request->method('getAuthId')->willReturn('123123123');
        
        $request->method('getPassword')->willReturn('123456');

        $repository = $this->createMock(AuthenticableUserRepositoryInterface::class);

        $password = $this->createMock(Password::class);
        
        $password->method('verify')->willReturn(true);

        $user = $this->createMock(AuthenticableUser::class);
        
        $user->method('getPassword')->willReturn($password);

        $repository->method('findByAuthId')->willReturn(null);

        $useCase = new LoginUseCase($repository);

        $response = $useCase->execute($request);

        $this->assertNull($response);
    }

    public function testLoginWithPasswordWrong(): void
    {
        $request = $this->createMock(LoginRequestInterface::class);
        
        $request->method('getAuthId')->willReturn('123123123');
        
        $request->method('getPassword')->willReturn('123456');

        $repository = $this->createMock(AuthenticableUserRepositoryInterface::class);

        $password = $this->createMock(Password::class);
        
        $password->method('verify')->willReturn(false);

        $user = $this->createMock(AuthenticableUser::class);
        
        $user->method('getPassword')->willReturn($password);

        $repository->method('findByAuthId')->willReturn($user);

        $useCase = new LoginUseCase($repository);

        $response = $useCase->execute($request);

        $this->assertNull($response);
    }
}