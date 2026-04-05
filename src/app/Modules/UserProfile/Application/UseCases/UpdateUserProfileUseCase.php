<?php

namespace App\Modules\UserProfile\Application\UseCases;

use App\Modules\UserManagement\Domain\ValueObjects\Email;
use App\Modules\UserProfile\Application\Requests\UpdateUserProfileRequestInterface;
use App\Modules\UserProfile\Domain\Events\UserProfileUpdated;
use App\Modules\UserProfile\Domain\Repositories\UserProfileRepositoryInterface;
use App\Modules\UserProfile\Domain\Services\EmailExistsCheckerInterface;
use App\Shared\Contracts\Events\EventDispatcherInterface;
use App\Shared\Contracts\UnitOfWork\UnitOfWorkInterface;

final class UpdateUserProfileUseCase
{
    public function __construct(
        private UserProfileRepositoryInterface $repository,
        private EmailExistsCheckerInterface $emailExistsChecker,
        private EventDispatcherInterface $eventDispatcher,
        private UnitOfWorkInterface $unitOfWork
    ) {}

    public function execute(UpdateUserProfileRequestInterface $request, string $actor_id): void
    {
        $userProfile = $this->repository->getUserProfile($actor_id);

        $new_email = (Email::fromString($request->getEmail()))->value();

        if ($new_email !== $userProfile->getEmail()) {
            $this->emailExistsChecker->check($new_email);
        }

        $userProfile->update(
            $request->getFirstName(), 
            $request->getLastName(), 
            $new_email
        );

        if (!$userProfile->hasChanges()) {
            return;
        }

        $this->unitOfWork->execute(function () use ($userProfile, $actor_id) {
            $this->repository->update($userProfile);

            $this->eventDispatcher->dispatch(new UserProfileUpdated(
                $actor_id,
                $userProfile->getChanges()
            ));
        });
    }
}