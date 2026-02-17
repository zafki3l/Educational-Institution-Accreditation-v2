<?php

namespace App\Modules\QualityAssessment\Presentation\Controllers;

use App\Shared\Http\Traits\HttpResponse;

abstract class QualityAssessmentController
{
    use HttpResponse;

    public const MODULE_NAME = 'QualityAssessment';
}