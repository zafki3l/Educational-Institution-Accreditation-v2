<?php

namespace App\Modules\QualityAssessment\Presentation\Controllers\Standard;

use App\Modules\QualityAssessment\Infrastructure\Models\Standard;
use App\Modules\QualityAssessment\Presentation\Controllers\QualityAssessmentController;
use App\Shared\Response\ViewResponse;

final class IndexStandardController extends QualityAssessmentController
{
    public function index(): ViewResponse
    {
        $standards = Standard::with('department')->get();

        return new ViewResponse(
            self::MODULE_NAME,
            'standard/index',
            'main.layouts',
            [
                'title' => 'Quản lý tiêu chuẩn đánh giá | ' . SYSTEM_NAME,
                'standards' => $standards
            ]
        );
    }
}