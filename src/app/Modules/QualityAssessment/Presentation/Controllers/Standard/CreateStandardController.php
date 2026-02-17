<?php

namespace App\Modules\QualityAssessment\Presentation\Controllers\Standard;

use App\Modules\QualityAssessment\Application\UseCases\Standard\CreateStandardUseCase;
use App\Modules\QualityAssessment\Presentation\Controllers\QualityAssessmentController;
use App\Modules\QualityAssessment\Presentation\Requests\Standard\CreateStandardRequest;
use App\Shared\Application\Contracts\DepartmentReader\DepartmentReaderInterface;
use App\Shared\Response\ViewResponse;
use App\Shared\SessionManager\AuthSession;

final class CreateStandardController extends QualityAssessmentController
{
    public function __construct(
        private DepartmentReaderInterface $departmentReader,
        private CreateStandardUseCase $createStandardUseCase
    ) {}

    public function create(): ViewResponse
    {
        $departments = $this->departmentReader->all();

        return new ViewResponse(
            self::MODULE_NAME,
            'standard/create',
            'main.layouts',
            [
                'departments' => $departments
            ]
        );
    }

    public function store(CreateStandardRequest $request)
    {
        $this->createStandardUseCase->execute($request, AuthSession::getUserId());

        $this->redirect('/standards');
    }
}