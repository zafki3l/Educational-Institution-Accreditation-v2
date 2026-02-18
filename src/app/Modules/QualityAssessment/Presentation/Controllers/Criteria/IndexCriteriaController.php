<?php

namespace App\Modules\QualityAssessment\Presentation\Controllers\Criteria;

use App\Modules\QualityAssessment\Infrastructure\Models\Standard;
use App\Modules\QualityAssessment\Presentation\Controllers\QualityAssessmentController;
use App\Shared\Response\ViewResponse;

final class IndexCriteriaController extends QualityAssessmentController
{
    public function index(): ViewResponse
    {
        $standards = Standard::with('criteria')->get();

        return new ViewResponse(
            self::MODULE_NAME,
            'criteria/index',
            'main.layouts',
            [
                'title' => 'Quản lý tiêu chí đánh giá | ' . SYSTEM_NAME,
                'standards' => $standards
            ]
        );
    }
}