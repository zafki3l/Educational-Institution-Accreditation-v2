<?php

namespace App\Modules\UserManagement\Application\UseCases;

use App\Modules\Authentication\Domain\ValueObjects\AuthId;
use App\Modules\UserManagement\Application\Requests\CreateUserRequestInterface;
use App\Modules\UserManagement\Domain\Entities\User;
use App\Modules\UserManagement\Domain\Repositories\UserRepositoryInterface;
use App\Modules\UserManagement\Domain\ValueObjects\Email;
use App\Modules\UserManagement\Domain\ValueObjects\Password;
use App\Modules\UserManagement\Domain\ValueObjects\UserId;
use App\Shared\Logging\LoggerInterface;

final class CreateUserUseCase
{
    public function __construct(
        private UserRepositoryInterface $userRepository,
        private LoggerInterface $logger
    ) {}

    public function execute(CreateUserRequestInterface $request, string $actor_id): void
    {
        $user = User::create(
            UserId::generate(),
            AuthId::generate(),
            $request->getFirstName(),
            $request->getLastName(),
            Email::fromString($request->getEmail()),
            Password::fromPlain($request->getPassword()),
            $request->getRoleId()
        );

        $created = $this->userRepository->create($user);

        $this->writeLog($created, $actor_id);
    }

    public function writeLog(User $user, string $actor_id): void
    {
        $this->logger->write(
            'info',
            'create', 
            "Người dùng {$actor_id} đã thêm một người dùng mới",
            $actor_id,
            [
                'id' => $user->getUserId()->value(),
                'first_name' => $user->getFirstName(),
                'last_name' => $user->getLastName(),
                'email' => $user->getEmail() ? $user->getEmail()->value() : '',
                'role_id' => $user->getRoleId()
            ]
        );
    }
}