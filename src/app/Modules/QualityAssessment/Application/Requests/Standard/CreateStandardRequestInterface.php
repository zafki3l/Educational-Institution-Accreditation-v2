<?php

namespace App\Modules\QualityAssessment\Application\Requests\Standard;

interface CreateStandardRequestInterface
{
    public function getId(): string;

    public function getName(): string;

    public function getDepartmentId(): string;
}