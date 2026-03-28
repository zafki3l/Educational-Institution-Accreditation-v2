<?php

namespace App\Modules\Authorization\Application\UseCases;

use App\Modules\Authorization\Application\Requests\UpdateRoleRequestInterface;
use App\Modules\Authorization\Domain\Events\RoleUpdated;
use App\Modules\Authorization\Domain\Repositories\RoleRepositoryInterface;
use App\Shared\Contracts\Events\EventDispatcherInterface;
use App\Shared\Contracts\UnitOfWork\UnitOfWorkInterface;

final class UpdateRoleUseCase
{
    public function __construct(
        private RoleRepositoryInterface $repository,
        private EventDispatcherInterface $eventDispatcher,
        private UnitOfWorkInterface $unitOfWork
    ) {}

    public function execute(UpdateRoleRequestInterface $request, string $actor_id): void
    {
        $request_id = $request->getId();
        $request_name = $request->getName();

        $role = $this->repository->findOrFail($request_id);

        $this->unitOfWork->execute(function () use ($role, $request_name, $actor_id) {
            $role->rename($request_name);

            $this->repository->update($role);

            $this->eventDispatcher->dispatch(new RoleUpdated(
                $role->getId(), 
                $role->getName(), 
                $actor_id
            ));
        });
    }
}
