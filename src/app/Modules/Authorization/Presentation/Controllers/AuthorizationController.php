<?php

namespace App\Modules\Authorization\Presentation\Controllers;

use App\Shared\Http\Traits\HttpResponse;

abstract class AuthorizationController
{
    use HttpResponse;

    public const MODULE_NAME = 'Authorization';
}
