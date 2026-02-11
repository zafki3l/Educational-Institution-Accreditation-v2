<?php

namespace App\Shared\Middlewares;

use App\Shared\Http\Traits\HttpResponse;

final class EnsureAuth
{
    use HttpResponse;

    public function handle(): void
    {
        if (!isAuth()) {
            $this->redirect('/login');
        }
    }
}