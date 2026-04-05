<?php

namespace App\Modules\StaffManagement\Presentation\Controllers;

use App\Shared\Web\Http\HttpResponse;

abstract class StaffController
{
    use HttpResponse;

    public const MODULE_NAME = 'StaffManagement';
}