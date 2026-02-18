<?php

namespace App\Modules\QualityAssessment\Presentation\Controllers\Criteria;

use App\Modules\QualityAssessment\Infrastructure\Models\Criteria;
use App\Modules\QualityAssessment\Presentation\Controllers\QualityAssessmentController;
use App\Modules\QualityAssessment\Presentation\Requests\Criteria\CreateCriteriaRequest;
use App\Shared\Application\Contracts\StandardReader\StandardReaderInterface;
use App\Shared\Response\ViewResponse;

final class CreateCriteriaController extends QualityAssessmentController
{
    public function __construct(private StandardReaderInterface $standardReader) {}

    public function create(): ViewResponse
    {
        $standards = $this->standardReader->all();

        return new ViewResponse(
            self::MODULE_NAME,
            'criteria/create',
            'main.layouts',
            [
                'title' => 'create',
                'standards' => $standards
            ]
        );
    }

    public function store(CreateCriteriaRequest $request)
    {
        Criteria::create([
            'id' => $request->getId(),
            'standard_id' => $request->getStandardId(),
            'name' => $request->getName()
        ]);

        $this->redirect('/criterias');
    }
}