<?php

namespace App\Modules\Authentication\Application\UseCases;

use App\Modules\Authentication\Domain\Events\UserLoggedOut;
use App\Shared\Contracts\Events\EventDispatcherInterface;
use App\Shared\Contracts\UnitOfWork\UnitOfWorkInterface;
use App\Shared\Security\Session\AuthSession;

final class LogoutUseCase
{
    public function __construct(
        private AuthSession $session,
        private EventDispatcherInterface $eventDispatcher,
        private UnitOfWorkInterface $unitOfWork
    ) {}

    public function execute(): void
    {
        $authUser = $this->session->authUser();

        if ($authUser) {
            $this->unitOfWork->execute(function () use ($authUser) {
                $this->eventDispatcher->dispatch(new UserLoggedOut($authUser->user_id));

                $this->session->clear();
            });
        }
    }
}