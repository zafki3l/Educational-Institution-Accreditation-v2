<?php

namespace App\Modules\QualityAssessment\Presentation\Controllers\Criteria;

use App\Modules\QualityAssessment\Application\UseCases\Criteria\CreateCriteriaUseCase;
use App\Modules\QualityAssessment\Presentation\Controllers\QualityAssessmentController;
use App\Modules\QualityAssessment\Presentation\Requests\Criteria\CreateCriteriaRequest;
use App\Shared\Application\Contracts\StandardReader\StandardReaderInterface;
use App\Shared\Response\ViewResponse;
use App\Shared\SessionManager\AuthSession;

final class CreateCriteriaController extends QualityAssessmentController
{
    public function __construct(
        private StandardReaderInterface $standardReader,
        private CreateCriteriaUseCase $createCriteriaUseCase
    ) {}

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

    public function store(CreateCriteriaRequest $request): void
    {
        $this->createCriteriaUseCase->execute($request, AuthSession::getUserId());

        $this->redirect('/criterias');
    }
}