<?php

namespace Tests\Feature\Modules\Authentication\Application\UseCases;

use App\Modules\Authentication\Application\UseCases\LogoutUseCase;
use App\Shared\SessionManager\AuthSession;
use PHPUnit\Framework\TestCase;

class LogoutUseCaseTest extends TestCase
{
    protected function setUp(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION = [];
    }

    public function testLogout()
    {
        AuthSession::set([
            'id' => '7364437b-8158-4131-abd5-45675bc14fe2',
            'auth_id' => 'ecb6efab3c5281462e5532cf270cfa7f'
        ]);

        $useCase = new LogoutUseCase();

        $useCase->execute();

        $this->assertArrayNotHasKey('auth_user', $_SESSION);
    }
}