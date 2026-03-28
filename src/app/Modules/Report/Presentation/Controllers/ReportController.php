<?php

namespace App\Modules\Report\Presentation\Controllers;

use App\Shared\Web\Http\HttpResponse;

abstract class ReportController
{
    use HttpResponse;
    
    public const MODULE_NAME = 'Report'; 
}