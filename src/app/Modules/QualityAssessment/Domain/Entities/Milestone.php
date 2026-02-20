<?php

namespace App\Modules\QualityAssessment\Domain\Entities;

use App\Modules\QualityAssessment\Domain\Exception\Criteria\CriteriaEmptyIdException;
use App\Modules\QualityAssessment\Domain\Exception\Milestone\MilestoneNameEmptyException;

class Milestone
{
    private function __construct(
        private ?int $id,
        private string $criteria_id,
        private string $code,
        private int $order,
        private string $name
    ) {}

    public static function create(
        ?int $id,
        string $criteria_id,
        string $code,
        int $order,
        string $name
    ): self {
        self::checkCriteriaIdEmpty($criteria_id);
        self::checkNameEmpty($name);

        return new self($id, $criteria_id, $code, $order, $name);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCriteriaId(): string
    {
        return $this->criteria_id;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getOrder(): int
    {
        return $this->order;
    }

    public function getName(): string
    {
        return $this->name;
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
}
