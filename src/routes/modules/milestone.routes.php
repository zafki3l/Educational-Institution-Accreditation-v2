<?php

use App\Modules\QualityAssessment\Presentation\Controllers\Milestone\CreateMilestoneController;
use App\Modules\QualityAssessment\Presentation\Controllers\Milestone\IndexMilestoneController;
use App\Shared\Middlewares\EnsureAuth;
use App\Shared\Middlewares\EnsureStaff;

$route->middleware([EnsureAuth::class, EnsureStaff::class])
    ->get('/criterias/{criteria_id}/milestones', [IndexMilestoneController::class, 'index']);

$route->middleware([EnsureAuth::class, EnsureStaff::class])
    ->post('/milestones', [CreateMilestoneController::class, 'store']);