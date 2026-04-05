<?php

namespace Tests\Modules\Authentication\Application\UseCases;

use App\Modules\Authentication\Application\UseCases\LogoutUseCase;
use App\Shared\Contracts\Events\EventDispatcherInterface;
use App\Shared\Contracts\UnitOfWork\UnitOfWorkInterface;
use App\Shared\Security\Session\AuthSession;
use App\Shared\Security\Session\SessionAuthUser;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

final class LogoutUseCaseTest extends TestCase
{
    private AuthSession&MockObject $sessionMock;
    private EventDispatcherInterface&MockObject $eventDispatcherMock;
    private UnitOfWorkInterface&MockObject $unitOfWorkMock;
    private LogoutUseCase $useCase;

    protected function setUp(): void
    {
        $this->sessionMock = $this->createMock(AuthSession::class);
        $this->eventDispatcherMock = $this->createMock(EventDispatcherInterface::class);
        $this->unitOfWorkMock = $this->createMock(UnitOfWorkInterface::class);
        
        $this->unitOfWorkMock->method('execute')
            ->willReturnCallback(fn(callable $work) => $work());

        $this->useCase = new LogoutUseCase(
            $this->sessionMock, 
            $this->eventDispatcherMock,
            $this->unitOfWorkMock
        );
    }

    public function testExecuteLogsOutUserWhenSessionIsActive(): void
    {
        $stubUser = new SessionAuthUser(
            user_id: 'user-123',
            identifier: 'test@example.com',
            role_id: 2
        );
    
        $this->sessionMock->method('authUser')->willReturn($stubUser);

        $this->eventDispatcherMock->expects($this->once())
            ->method('dispatch');
            
        $this->sessionMock->expects($this->once())
            ->method('clear');

        $this->useCase->execute();
    }

    public function testExecuteDoesNothingWhenNoUserInSession(): void
    {
        $this->sessionMock->method('authUser')->willReturn(null);

        $this->eventDispatcherMock->expects($this->never())->method('dispatch');
        $this->sessionMock->expects($this->never())->method('clear');

        $this->useCase->execute();
    }
}