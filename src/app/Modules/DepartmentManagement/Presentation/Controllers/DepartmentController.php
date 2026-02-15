<?php

namespace App\Modules\DepartmentManagement\Presentation\Controllers;

use App\Shared\Http\Traits\HttpResponse;

abstract class DepartmentController
{
    use HttpResponse;

    public const MODULE_NAME = 'DepartmentManagement';
}