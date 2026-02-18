<?php

use App\Modules\QualityAssessment\Presentation\Controllers\Criteria\IndexCriteriaController;
use App\Shared\Middlewares\EnsureAuth;
use App\Shared\Middlewares\EnsureStaff;

$route->middleware([EnsureAuth::class, EnsureStaff::class])
    ->get('/criterias', [IndexCriteriaController::class, 'index']);