<?php

namespace App\Modules\QualityAssessment\Application\Requests\Criteria;

interface UpdateCriteriaRequestInterface
{
    public function getId(): string;

    public function getStandardId(): string;

    public function getName(): string;
}