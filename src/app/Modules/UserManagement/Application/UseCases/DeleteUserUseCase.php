<?php

namespace App\Modules\UserManagement\Application\UseCases;

use App\Modules\UserManagement\Domain\Events\UserDeleted;
use App\Modules\UserManagement\Domain\Repositories\UserRepositoryInterface;
use App\Shared\Contracts\Events\EventDispatcherInterface;
use App\Shared\Contracts\UnitOfWork\UnitOfWorkInterface;

final class DeleteUserUseCase
{
    public function __construct(
        private UserRepositoryInterface $repository,
        private EventDispatcherInterface $eventDispatcher,
        private UnitOfWorkInterface $unitOfWork
    ) {}

    public function execute(string $id, string $actor_id): void
    {
        $user = $this->repository->findOrFail($id);

        if (!$user) {
            return;
        }

        $this->unitOfWork->execute(function () use ($id, $user, $actor_id) {
            $this->repository->delete($id);

            $this->eventDispatcher->dispatch(new UserDeleted(
                $user->getUserId()->value(), 
                $actor_id
            ));
        });
    }
}