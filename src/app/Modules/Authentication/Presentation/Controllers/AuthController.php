<?php

namespace App\Modules\Authentication\Presentation\Controllers;

use App\Modules\Authentication\Presentation\Requests\LoginRequest;
use App\Shared\Http\Traits\HttpResponse;
use App\Shared\Response\ViewResponse;

class AuthController
{
    use HttpResponse;

    public const MODULE_NAME = 'Authentication';

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

    public function login(LoginRequest $request)
    {
        
    }
}