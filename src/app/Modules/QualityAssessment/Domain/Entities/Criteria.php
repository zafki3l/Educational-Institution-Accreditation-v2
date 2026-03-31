<?php

namespace App\Modules\QualityAssessment\Domain\Entities;

use App\Modules\QualityAssessment\Domain\Exception\Criteria\CriteriaEmptyIdException;
use App\Modules\QualityAssessment\Domain\Exception\Criteria\CriteriaEmptyNameException;
use App\Modules\QualityAssessment\Domain\Exception\Criteria\CriteriaIdInvalidFormatException;
use App\Modules\QualityAssessment\Domain\Exception\Standard\StandardEmptyIdException;

class Criteria
{
    private array $changes = [];

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

        self::checkStandardIdEmpty($standard_id);

        self::checkNameEmpty($name);

        static::validateFormat($id, $standard_id);

        return new self($id, $standard_id, $name);
    }

    public function update(string $name): void
    {
        self::checkNameEmpty($name);

        if ($this->name !== $name) {
            $this->changes['name'] = [
                'old' => $this->name,
                'new' => $name
            ];

            $this->name = $name;
        }
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

    public function getChanges(): array
    {
        return $this->changes;
    }

    public function hasChanges(): bool
    {
        return !empty($this->changes);
    }

    private static function validateFormat(string $id, string $standard_id): void
    {
        $pattern = '/^' . preg_quote($standard_id, '/') . '\.(?:[1-9]\d*)$/';

        if (!preg_match($pattern, $id)) {
            throw new CriteriaIdInvalidFormatException();
        }
    }

    private static function checkStandardIdEmpty(string $standard_id): void
    {
        if ($standard_id === '') {
            throw new StandardEmptyIdException();
        }
    }

    private static function checkNameEmpty(string $name): void
    {
        if ($name === '') {
            throw new CriteriaEmptyNameException();
        }
    }
}
