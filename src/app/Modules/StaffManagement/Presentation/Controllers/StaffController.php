<?php

namespace App\Modules\StaffManagement\Presentation\Controllers;

use App\Shared\Http\Traits\HttpResponse;

abstract class StaffController
{
    use HttpResponse;

    public const MODULE_NAME = 'StaffManagement';
}