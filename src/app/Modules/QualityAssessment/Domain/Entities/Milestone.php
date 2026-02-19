<?php

namespace App\Modules\QualityAssessment\Domain\Entities;

use App\Modules\QualityAssessment\Domain\Exception\Criteria\CriteriaEmptyIdException;
use App\Modules\QualityAssessment\Domain\Exception\Milestone\MilestoneIdEmptyException;
use App\Modules\QualityAssessment\Domain\Exception\Milestone\MilestoneInvalidIdException;
use App\Modules\QualityAssessment\Domain\Exception\Milestone\MilestoneNameEmptyException;

class Milestone
{
    private function __construct(
        private string $id,
        private string $criteria_id,
        private string $name
    ) {}

    public static function create(
        string $id,
        string $criteria_id,
        string $name
    ): self {
        self::checkIdEmpty($id);
        self::checkInvalidFormatID($id);
        self::checkCriteriaIdEmpty($criteria_id);
        self::checkNameEmpty($name);

        return new self($id, $criteria_id, $name);
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getCriteriaId(): string
    {
        return $this->criteria_id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    private static function checkIdEmpty(string $id): void
    {
        if ($id === '') {
            throw new MilestoneIdEmptyException();
        }
    }

    private static function checkCriteriaIdEmpty(string $criteria_id): void
    {
        if ($criteria_id === '') {
            throw new CriteriaEmptyIdException();
        }
    }

    private static function checkNameEmpty(string $name): void
    {
        if ($name === '') {
            throw new MilestoneNameEmptyException();
        }
    }

    private static function checkInvalidFormatID(string $id): void
    {
        if (!ctype_digit($id) || (int) $id <= 0) {
            throw new MilestoneInvalidIdException();
        }
    }
}
