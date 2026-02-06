<?php

namespace App\Modules\Authentication\Application\UseCases;

use App\Modules\Authentication\Application\Requests\LoginRequestInterface;
use App\Modules\Authentication\Domain\Entities\AuthenticableUser;
use App\Modules\Authentication\Domain\Repositories\AuthenticableUserRepositoryInterface;
use App\Modules\UserManagement\Domain\ValueObjects\Password;

class LoginUseCase
{
    private const DUMMY_HASH = '$2y$10$usesomesillystringfore7hnbRJHxXVLeakoG8K30oukPsA.ztMG';

    public function __construct(private AuthenticableUserRepositoryInterface $repository) {}

    public function execute(LoginRequestInterface $request): ?AuthenticableUser
    {
        $authUser = $this->repository->findByAuthId($request->getAuthId());
        
        $password = $this->getHashedPassword($authUser);

        if (!$password->verify($request->getPassword()) || !$authUser) {
            return null;
        }

        return $authUser;
    }

    private function getHashedPassword(?AuthenticableUser $authUser): Password
    {
        return $authUser 
            ? $authUser->getPassword()
            : Password::fromHash(self::DUMMY_HASH);
    }
}
