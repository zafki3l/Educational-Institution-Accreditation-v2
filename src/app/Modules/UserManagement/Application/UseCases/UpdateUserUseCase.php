<?php

namespace App\Modules\UserManagement\Application\UseCases;

use App\Modules\UserManagement\Application\Requests\UpdateUserRequestInterface;
use App\Modules\UserManagement\Domain\Repositories\UserRepositoryInterface;
use App\Modules\UserManagement\Domain\ValueObjects\Email;

class UpdateUserUseCase
{
    public function __construct(private UserRepositoryInterface $repository) {}

    public function execute(UpdateUserRequestInterface $request)
    {
        $user = $this->repository->findOrFail($request->getId());

        $user->update(
            $request->getFirstName(), 
            $request->getLastName(), 
            Email::fromString($request->getEmail()), 
            $request->getRoleId()
        );

        $this->repository->save($user);
    }
}