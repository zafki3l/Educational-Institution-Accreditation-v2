<?php

namespace App\Modules\QualityAssessment\Presentation\Controllers\Standard;

use App\Modules\QualityAssessment\Infrastructure\Models\Standard;
use App\Modules\QualityAssessment\Presentation\Controllers\QualityAssessmentController;
use App\Modules\QualityAssessment\Presentation\Requests\Standard\CreateStandardRequest;
use App\Shared\Application\Contracts\DepartmentReader\DepartmentReaderInterface;
use App\Shared\Response\ViewResponse;

final class CreateStandardController extends QualityAssessmentController
{
    public function __construct(private DepartmentReaderInterface $departmentReader) {}

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
        Standard::create([
            'id' => $request->getId(),
            'name' => $request->getName(),
            'department_id' => $request->getDepartmentId()
        ]);

        $this->redirect('/standards');
    }
}