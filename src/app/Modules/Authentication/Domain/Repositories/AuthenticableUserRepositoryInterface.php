<?php

namespace App\Modules\Authentication\Domain\Repositories;

use App\Modules\Authentication\Domain\Entities\AuthenticableUser;

interface AuthenticableUserRepositoryInterface
{
    public function findByAuthId(string $auth_id): ?AuthenticableUser;

    public function findByUserId(string $user_id): ?AuthenticableUser;
}