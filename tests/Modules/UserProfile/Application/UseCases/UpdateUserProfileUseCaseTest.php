<?php

namespace Tests\Unit\Modules\UserProfile\Application\UseCases;

use App\Modules\UserProfile\Application\Requests\UpdateUserProfileRequestInterface;
use App\Modules\UserProfile\Application\UseCases\UpdateUserProfileUseCase;
use App\Modules\UserProfile\Domain\Entities\UserProfile;
use App\Modules\UserProfile\Domain\Repositories\UserProfileRepositoryInterface;
use App\Modules\UserProfile\Domain\Services\EmailExistsCheckerInterface;
use App\Shared\Contracts\Events\EventDispatcherInterface;
use App\Shared\Contracts\UnitOfWork\UnitOfWorkInterface;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;
use Tests\TraitHelper\DebugHelper;

class UpdateUserProfileUseCaseTest extends TestCase
{
    use DebugHelper;

    private UserProfileRepositoryInterface&MockObject $repository;
    private EmailExistsCheckerInterface&MockObject $emailChecker;
    private EventDispatcherInterface&MockObject $eventDispatcher;
    private UnitOfWorkInterface&MockObject $unitOfWork;
    private UpdateUserProfileUseCase $useCase;

    protected function setUp(): void
    {
        $this->repository = $this->createMock(UserProfileRepositoryInterface::class);
        $this->emailChecker = $this->createMock(EmailExistsCheckerInterface::class);
        $this->eventDispatcher = $this->createMock(EventDispatcherInterface::class);
        $this->unitOfWork = $this->createMock(UnitOfWorkInterface::class);

        $this->unitOfWork->method('execute')
            ->willReturnCallback(fn(callable $work) => $work());

        $this->useCase = new UpdateUserProfileUseCase(
            $this->repository,
            $this->emailChecker,
            $this->eventDispatcher,
            $this->unitOfWork
        );
    }

    public function testExecuteSuccessfullyWithEmailChange(): void
    {
        $actorId = 'user-123';
        $newEmail = 'new@example.com';
        $oldEmail = 'old@example.com';

        $request = $this->createMock(UpdateUserProfileRequestInterface::class);
        $request->method('getFirstName')->willReturn('Nguyen');
        $request->method('getLastName')->willReturn('An');
        $request->method('getEmail')->willReturn($newEmail);

        $fromDb = UserProfile::fromPersistent($actorId, 'Old', 'Name', $oldEmail, null);
        $this->repository->method('getUserProfile')->with($actorId)->willReturn($fromDb);

        $this->emailChecker->expects($this->once())
            ->method('check')
            ->with($newEmail);

        $this->repository->expects($this->once())->method('update');
        $this->eventDispatcher->expects($this->once())->method('dispatch');

        $this->useCase->execute($request, $actorId);
        
        $this->debug('SUCCESS', ['new_email' => $fromDb->getEmail()]);
    }

    public function testExecuteThrowsExceptionWhenEmailAlreadyExists(): void
    {
        $actorId = 'user-123';
        $newEmail = 'exists@example.com';

        $request = $this->createMock(UpdateUserProfileRequestInterface::class);
        $request->method('getEmail')->willReturn($newEmail);

        $fromDb = UserProfile::fromPersistent($actorId, 'Nguyen', 'An', 'old@example.com', null);
        $this->repository->method('getUserProfile')->willReturn($fromDb);

        $this->emailChecker->method('check')
            ->willThrowException(new \Exception("Email already exists"));

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage("Email already exists");

        $this->useCase->execute($request, $actorId);
    }

    public function testExecuteDoesNotCheckEmailIfItIsSameAsCurrent(): void
    {
        $actorId = 'user-123';
        $currentEmail = 'same@example.com';

        $request = $this->createMock(UpdateUserProfileRequestInterface::class);
        $request->method('getEmail')->willReturn($currentEmail);
        $request->method('getFirstName')->willReturn('NewFirstName');

        $fromDb = UserProfile::fromPersistent($actorId, 'OldName', 'An', $currentEmail, null);
        $this->repository->method('getUserProfile')->willReturn($fromDb);

        $this->emailChecker->expects($this->never())->method('check');
        
        $this->repository->expects($this->once())->method('update');

        $this->useCase->execute($request, $actorId);
        
        $this->debug('EARLY_BYPASS_CHECKER', ['email' => $currentEmail]);
    }

    public function testExecuteEarlyReturnsWhenNoChangesAtAll(): void
    {
        $actorId = 'user-123';
        $email = 'same@example.com';
        $fname = 'Nguyen';
        $lname = 'An';

        $request = $this->createMock(UpdateUserProfileRequestInterface::class);
        $request->method('getEmail')->willReturn($email);
        $request->method('getFirstName')->willReturn($fname);
        $request->method('getLastName')->willReturn($lname);

        $fromDb = UserProfile::fromPersistent($actorId, $fname, $lname, $email, null);
        $this->repository->method('getUserProfile')->willReturn($fromDb);

        $this->repository->expects($this->never())->method('update');
        $this->unitOfWork->expects($this->never())->method('execute');

        $this->useCase->execute($request, $actorId);
    }
}