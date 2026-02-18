<?php

namespace App\Modules\QualityAssessment\Domain\Entities;

use App\Modules\QualityAssessment\Domain\Exception\Criteria\CriteriaEmptyIdException;
use App\Modules\QualityAssessment\Domain\Exception\Criteria\CriteriaEmptyNameException;
use App\Modules\QualityAssessment\Domain\Exception\Criteria\CriteriaIdInvalidFormatException;
use App\Modules\QualityAssessment\Domain\Exception\Standard\StandardEmptyIdException;

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
        if ($id === '') {
            throw new CriteriaEmptyIdException();
        }

        if ($standard_id === '') {
            throw new StandardEmptyIdException();
        }

        if ($name === '') {
            throw new CriteriaEmptyNameException();
        }

        static::validateFormat($id, $standard_id);

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

    private static function validateFormat(string $id, string $standard_id): void
    {
        $pattern = '/^' . preg_quote($standard_id, '/') . '\.(?:[1-9]\d*)$/';

        if (!preg_match($pattern, $id)) {
            throw new CriteriaIdInvalidFormatException();
        }
    }
}
