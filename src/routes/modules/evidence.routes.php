<?php

use App\Modules\QualityAssessment\Presentation\Controllers\Evidence\IndexEvidenceController;
use App\Shared\Middlewares\EnsureAuth;
use App\Shared\Middlewares\EnsureStaff;

$route->middleware([EnsureAuth::class, EnsureStaff::class])
    ->get('/criterias/{criteria_id}/evidences', [IndexEvidenceController::class, 'index']);