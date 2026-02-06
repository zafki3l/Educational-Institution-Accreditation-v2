<?php

namespace App\Modules\Authentication\Presentation\Controllers;

use App\Modules\Authentication\Application\UseCases\LoginUseCase;
use App\Modules\Authentication\Application\UseCases\LogoutUseCase;
use App\Modules\Authentication\Presentation\Requests\LoginRequest;
use App\Shared\Http\Traits\HttpResponse;
use App\Shared\Response\ViewResponse;
use App\Shared\SessionManager\AuthSession;
use Exception;

class AuthController
{
    use HttpResponse;

    public const MODULE_NAME = 'Authentication';

    public function __construct(
        private LoginUseCase $loginUseCase,
        private LogoutUseCase $logoutUseCase
    ) {}

    public function showLogin(): ViewResponse
    {
        return new ViewResponse(
            self::MODULE_NAME,
            'login/main',
            'login.layouts',
            [
                'title' => 'Đăng nhập | ' . SYSTEM_NAME
            ]
        );
    }

    public function login(LoginRequest $request): void
    {
        $auth_user = $this->loginUseCase->execute($request);

        if (!$auth_user) {
            $_SESSION['login_errors'] = 'Mã xác thực hoặc mật khẩu không hợp lệ!';

            $this->redirect(HOST . '/login');
        }

        session_regenerate_id(true);

        AuthSession::set([
            'user_id' => $auth_user->getUserId(),
            'auth_id' => $auth_user->getAuthId()
        ]);

        $this->redirect(HOST . '/users');
    }

    public function logout()
    {
        $this->logoutUseCase->execute();

        $this->redirect(HOST . '/login');
    }
}
