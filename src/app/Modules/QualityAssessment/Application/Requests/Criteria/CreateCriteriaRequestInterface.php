<?php

namespace App\Modules\QualityAssessment\Application\Requests\Criteria;

interface CreateCriteriaRequestInterface
{
    public function getId(): string;

    public function getStandardId(): string;

    public function getName(): string;
}