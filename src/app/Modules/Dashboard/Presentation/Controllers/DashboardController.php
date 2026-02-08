<?php

namespace App\Modules\Dashboard\Presentation\Controllers;

use App\Shared\Http\Traits\HttpResponse;

abstract class DashboardController 
{
    use HttpResponse;
    
    protected const MODULE_NAME = 'Dashboard';
}