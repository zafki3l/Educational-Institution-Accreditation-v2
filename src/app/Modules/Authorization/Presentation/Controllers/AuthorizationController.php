<?php

namespace App\Modules\Authorization\Presentation\Controllers;

use App\Shared\Web\Http\HttpResponse;

abstract class AuthorizationController
{
    use HttpResponse;

    public const MODULE_NAME = 'Authorization';
}
