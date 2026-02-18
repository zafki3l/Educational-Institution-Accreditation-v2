<?php

namespace App\Modules\QualityAssessment\Domain\Entities;

class Criteria
{
    private function __construct(
        private string $id,
        private string $standard_id,
        private string $name
    ) {}

    public static function create(
        string $id,
        string $standard_id,
        string $name
    ): self {
        return new self($id, $standard_id, $name);
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
