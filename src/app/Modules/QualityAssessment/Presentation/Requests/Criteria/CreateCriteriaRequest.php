<?php

namespace App\Modules\QualityAssessment\Presentation\Requests\Criteria;

use App\Modules\QualityAssessment\Application\Requests\Criteria\CreateCriteriaRequestInterface;

final class CreateCriteriaRequest implements CreateCriteriaRequestInterface
{
    private string $id;
    private string $standard_id;
    private string $name;

    public function __construct()
    {
        $this->id = $_POST['id'];
        $this->standard_id = $_POST['standard_id'];
        $this->name = $_POST['name'];
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getStandardId(): string
    {
        return $this->standard_id;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
