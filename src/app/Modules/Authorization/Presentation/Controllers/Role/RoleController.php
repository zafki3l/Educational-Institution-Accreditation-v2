<?php

namespace App\Modules\Authorization\Presentation\Controllers\Role;

use App\Shared\Http\Traits\HttpResponse;

abstract class RoleController
{
    use HttpResponse;

    public const MODULE_NAME = 'Authorization';
}
