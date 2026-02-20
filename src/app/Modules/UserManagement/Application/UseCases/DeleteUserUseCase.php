<?php

namespace App\Modules\UserManagement\Application\UseCases;

use App\Modules\UserManagement\Domain\Entities\User;
use App\Modules\UserManagement\Domain\Repositories\UserRepositoryInterface;
use App\Shared\Logging\LoggerInterface;

final class DeleteUserUseCase
{
    public function __construct(
        private UserRepositoryInterface $repository,
        private LoggerInterface $logger
    ) {}

    public function execute(string $id, string $actor_id): void
    {
        $user = $this->repository->findOrFail($id);

        $this->repository->delete($id);

        $this->writeLog($user, $actor_id);
    }

    private function writeLog(User $user, string $actor_id): void
    {
        $this->logger->write(
            'info',
            'delete', 
            "Người dùng {$actor_id} đã xóa người dùng {$user->getUserId()->value()}",
            $actor_id,
            [
                'id' => $user->getUserId()->value(),
                'first_name' => $user->getFirstName(),
                'last_name' => $user->getLastName(),
                'email' => $user->getEmail() ? $user->getEmail()->value() : null,
                'role_id' => $user->getRoleId(),
                'department_id' => $user->getDepartmentId() ? $user->getDepartmentId() : null
            ]
        );
    }
}