<?php

namespace Tests\Unit\Modules\UserProfile\Application\UseCases;

use App\Modules\UserProfile\Application\Requests\ChangePasswordRequestInterface;
use App\Modules\UserProfile\Application\UseCases\ChangePasswordUseCase;
use App\Modules\UserProfile\Domain\Entities\UserProfile;
use App\Modules\UserProfile\Domain\Repositories\UserProfileRepositoryInterface;
use App\Modules\UserProfile\Domain\Services\VerifyCurrentPasswordInterface;
use App\Modules\UserProfile\Domain\Services\NewPasswordMatchingCheckerInterface;
use App\Shared\Contracts\Events\EventDispatcherInterface;
use App\Shared\Contracts\UnitOfWork\UnitOfWorkInterface;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;
use Tests\TraitHelper\DebugHelper;

final class ChangePasswordUseCaseTest extends TestCase
{
    use DebugHelper;

    private UserProfileRepositoryInterface&MockObject $repository;
    private VerifyCurrentPasswordInterface&MockObject $verifyCurrentPassword;
    private NewPasswordMatchingCheckerInterface&MockObject $newPasswordMatchingChecker;
    private EventDispatcherInterface&MockObject $eventDispatcher;
    private UnitOfWorkInterface&MockObject $unitOfWork;
    private ChangePasswordUseCase $useCase;

    protected function setUp(): void
    {
        $this->repository = $this->createMock(UserProfileRepositoryInterface::class);
        $this->verifyCurrentPassword = $this->createMock(VerifyCurrentPasswordInterface::class);
        $this->newPasswordMatchingChecker = $this->createMock(NewPasswordMatchingCheckerInterface::class);
        $this->eventDispatcher = $this->createMock(EventDispatcherInterface::class);
        $this->unitOfWork = $this->createMock(UnitOfWorkInterface::class);

        $this->unitOfWork->method('execute')
            ->willReturnCallback(fn(callable $work) => $work());

        $this->useCase = new ChangePasswordUseCase(
            $this->repository,
            $this->verifyCurrentPassword,
            $this->newPasswordMatchingChecker,
            $this->eventDispatcher,
            $this->unitOfWork
        );
    }

    public function testExecuteSuccessfully(): void
    {
        $actorId = 'user-123';
        $oldPass = 'OldPassword123@';
        $newPass = 'NewPassword123@';
        $hashedOldPass = 'hashed_old_password';

        $request = $this->createMock(ChangePasswordRequestInterface::class);
        $request->method('getCurrentPassword')->willReturn($oldPass);
        $request->method('getNewPassword')->willReturn($newPass);
        $request->method('getNewPasswordConfirmation')->willReturn($newPass);

        $userProfile = $this->createMock(UserProfile::class);
        $userProfile->method('getId')->willReturn($actorId);
        $userProfile->method('getPassword')->willReturn($hashedOldPass);

        $this->repository->method('getUserProfile')->with($actorId)->willReturn($userProfile);

        $this->verifyCurrentPassword->expects($this->once())
            ->method('verify')
            ->with($oldPass, $hashedOldPass);

        $this->newPasswordMatchingChecker->expects($this->once())
            ->method('check')
            ->with($newPass, $newPass);

        $this->repository->expects($this->once())
            ->method('changePassword')
            ->with($this->anything(), $actorId);

        $this->eventDispatcher->expects($this->once())
            ->method('dispatch');

        $this->useCase->execute($request, $actorId);
        
        $this->debug('SUCCESS', 'Password changed and event dispatched');
    }

    public function testExecuteThrowsExceptionWhenNewPasswordNotMatching(): void
    {
        $actorId = 'user-123';
        $request = $this->createMock(ChangePasswordRequestInterface::class);
        $request->method('getNewPassword')->willReturn('p1');
        $request->method('getNewPasswordConfirmation')->willReturn('p2');

        $userProfile = $this->createMock(UserProfile::class);
        $userProfile->method('getPassword')->willReturn('some_hash'); 
        $this->repository->method('getUserProfile')->willReturn($userProfile);

        $this->newPasswordMatchingChecker->method('check')
            ->willThrowException(new \Exception('Mật khẩu xác nhận không khớp'));

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Mật khẩu xác nhận không khớp');

        $this->useCase->execute($request, $actorId);
    }

    public function testExecuteEarlyReturnWhenPasswordIsSame(): void
    {
        $actorId = 'user-123';
        $password = 'SamePassword123@';

        $request = $this->createMock(ChangePasswordRequestInterface::class);
        $request->method('getCurrentPassword')->willReturn($password);
        $request->method('getNewPassword')->willReturn($password);

        $userProfile = $this->createMock(UserProfile::class);
        $userProfile->method('getPassword')->willReturn('some_hash');
        $this->repository->method('getUserProfile')->willReturn($userProfile);

        $this->unitOfWork->expects($this->never())->method('execute');
        $this->repository->expects($this->never())->method('changePassword');

        $this->useCase->execute($request, $actorId);
        
        $this->debug('EARLY_RETURN', 'No DB action because password is unchanged');
    }

    public function testExecuteThrowsExceptionWhenCurrentPasswordInvalid(): void
    {
        $request = $this->createMock(ChangePasswordRequestInterface::class);
        $userProfile = $this->createMock(UserProfile::class);
        $userProfile->method('getPassword')->willReturn('hash');
        $this->repository->method('getUserProfile')->willReturn($userProfile);
        
        $this->verifyCurrentPassword->method('verify')
            ->willThrowException(new \Exception('Mật khẩu hiện tại không chính xác'));

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Mật khẩu hiện tại không chính xác');

        $this->useCase->execute($request, 'user-123');
    }
}