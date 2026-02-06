<?php

namespace App\Modules\UserManagement\Application\UseCases;

use App\Modules\Authentication\Domain\ValueObjects\AuthId;
use App\Modules\Role\Domain\Repositories\RoleRepositoryInterface;
use App\Modules\Role\Infrastructure\Models\Role;
use App\Modules\UserManagement\Application\Requests\CreateUserRequestInterface;
use App\Modules\UserManagement\Domain\Entities\User;
use App\Modules\UserManagement\Domain\ValueObjects\Email;
use App\Modules\UserManagement\Domain\ValueObjects\Password;
use App\Modules\UserManagement\Domain\ValueObjects\UserId;
use App\Modules\UserManagement\Infrastructure\Models\User as ModelsUser;

class CreateUserUseCase
{
    public function __construct(private RoleRepositoryInterface $roleRepository) {}

    public function execute(CreateUserRequestInterface $request)
    {
        $role = $this->roleRepository->findOrFail($request->getRoleId());

        $user = User::create(
            UserId::generate(),
            AuthId::generate(),
            $request->getFirstName(),
            $request->getLastName(),
            Email::fromString($request->getEmail()),
            Password::fromPlain($request->getPassword()),
            $role
        );

        return ModelsUser::create([
            'id' => $user->getUserId()->value(),
            'auth_id' => $user->getAuthId()->value(),
            'first_name' => $user->getFirstName(),
            'last_name' => $user->getLastName(),
            'email' => $user->getEmail()->value(),
            'password' => $user->getPassword()->value(),
            'role_id' => $user->getRole()->getId()
        ]);
    }
}