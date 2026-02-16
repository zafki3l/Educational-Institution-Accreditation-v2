<?php

namespace App\Modules\UserManagement\Application\UseCases;

use App\Modules\UserManagement\Application\Requests\UpdateUserRequestInterface;
use App\Modules\UserManagement\Domain\Repositories\UserRepositoryInterface;
use App\Shared\Logging\LoggerInterface;

final class UpdateUserUseCase
{
    public function __construct(
        private UserRepositoryInterface $repository,
        private LoggerInterface $logger
    ) {}

    public function execute(UpdateUserRequestInterface $request, string $actor_id)
    {
        $user = $this->repository->findOrFail($request->getId());

        $user->update(
            $request->getFirstName(), 
            $request->getLastName(), 
            $request->getEmail() == '' ? null : $request->getEmail(), 
            $request->getRoleId(),
            $request->getDepartmentId() == '' ? null : $request->getDepartmentId()
        );

        $this->repository->save($user);

        $this->writeLog($request, $actor_id);
    }

    public function writeLog(UpdateUserRequestInterface $request, string $actor_id): void
    {
        $this->logger->write(
            'info',
            'update', 
            "Người dùng {$actor_id} đã cập nhật thông tin của người dùng {$request->getId()}",
            $actor_id,
            [
                'first_name' => $request->getFirstName(),
                'last_name' => $request->getLastName(),
                'email' => $request->getEmail() ?? '',
                'role_id' => $request->getRoleId()
            ]
        );
    }
}