<?php

namespace App\Modules\QualityAssessment\Presentation\Controllers\Evidence;

use App\Modules\QualityAssessment\Presentation\Controllers\QualityAssessmentController;
use App\Shared\Application\Contracts\StandardReader\StandardReaderInterface;
use App\Shared\Response\ViewResponse;

final class IndexEvidenceController extends QualityAssessmentController
{
    public function __construct(private StandardReaderInterface $standardReader) {}

    public function index(): ViewResponse
    {
        $standards = $this->standardReader->withCriteria();

        return new ViewResponse(
            self::MODULE_NAME,
            'evidence/index',
            'main.layouts',
            [
                'title' => 'Quản lý minh chứng đánh giá | ' . SYSTEM_NAME,
                'standards' => $standards
            ]
        );
    }
}