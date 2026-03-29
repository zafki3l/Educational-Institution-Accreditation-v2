<?php

namespace App\Modules\UserProfile\Application\UseCases;

use App\Modules\UserManagement\Domain\ValueObjects\Password;
use App\Modules\UserProfile\Application\Requests\ChangePasswordRequestInterface;
use App\Modules\UserProfile\Domain\Events\PasswordChanged;
use App\Modules\UserProfile\Domain\Repositories\UserProfileRepositoryInterface;
use App\Modules\UserProfile\Domain\Services\NewPasswordMatchingCheckerInterface;
use App\Modules\UserProfile\Domain\Services\VerifyCurrentPasswordInterface;
use App\Shared\Contracts\Events\EventDispatcherInterface;
use App\Shared\Contracts\UnitOfWork\UnitOfWorkInterface;

final class ChangePasswordUseCase
{
    public function __construct(
        private UserProfileRepositoryInterface $repository,
        private VerifyCurrentPasswordInterface $verifyCurrentPassword,
        private NewPasswordMatchingCheckerInterface $newPasswordMatchingChecker,
        private EventDispatcherInterface $eventDispatcher,
        private UnitOfWorkInterface $unitOfWork
    ) {}

    public function execute(ChangePasswordRequestInterface $request, string $actor_id): void
    {
        $userProfile = $this->repository->getUserProfile($actor_id);

        $this->verifyCurrentPassword->verify($request->getCurrentPassword(), $userProfile->getPassword());

        $this->newPasswordMatchingChecker->check($request->getNewPassword(), $request->getNewPasswordConfirmation());

        if ($request->getNewPassword() === $request->getCurrentPassword()) {
            return;
        }

        $userProfile->changePassword((Password::fromPlain($request->getNewPassword()))->value());

        $this->unitOfWork->execute(function () use ($userProfile, $actor_id) {
            $this->repository->changePassword($userProfile->getPassword(), $userProfile->getId());

            $this->eventDispatcher->dispatch(new PasswordChanged($actor_id));
        });
    }
}