<?php

namespace App\Modules\Authentication\Application\UseCases;

use App\Shared\SessionManager\AuthSession;

final class LogoutUseCase
{
    public function execute(): void
    {
        AuthSession::clear();
    }
}