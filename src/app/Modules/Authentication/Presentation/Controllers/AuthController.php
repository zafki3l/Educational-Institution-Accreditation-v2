<?php

namespace App\Modules\Authentication\Presentation\Controllers;

use App\Shared\Http\Traits\HttpResponse;

abstract class AuthController
{
    use HttpResponse;

    protected const MODULE_NAME = 'Authentication';
}
