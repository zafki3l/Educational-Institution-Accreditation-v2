<?php

namespace App\Modules\DepartmentManagement\Presentation\Controllers;

use App\Shared\Web\Http\HttpResponse;

abstract class DepartmentController
{
    use HttpResponse;

    public const MODULE_NAME = 'DepartmentManagement';
}