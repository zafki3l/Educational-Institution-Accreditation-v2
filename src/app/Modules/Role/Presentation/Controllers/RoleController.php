<?php

namespace App\Modules\Role\Presentation\Controllers;

use App\Shared\Http\Traits\HttpResponse;

abstract class RoleController
{
    use HttpResponse;

    public const MODULE_NAME = 'Role';
}
