<?php

namespace App\Modules\UserManagement\Presentation\Controllers;

use App\Shared\Web\Http\HttpResponse;

abstract class UserController
{
    use HttpResponse;

    protected const MODULE_NAME = 'UserManagement';
}