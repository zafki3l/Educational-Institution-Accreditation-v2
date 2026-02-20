<?php

namespace App\Modules\QualityAssessment\Domain\ValueObjects\Milestone;

use App\Modules\QualityAssessment\Domain\Exception\Milestone\MilestoneCodeInvalidException;

final class MilestoneCode
{
    private function __construct(private string $value) {}

    public static function generate(string $criteria_id, int $order): self
    {
        $code = "{$criteria_id}.{$order}";

        return new self($code);
    }

    public static function fromString(string $code): self
    {
        if (!preg_match('/^\d+\.\d+\.\d+$/', $code)) {
            throw new MilestoneCodeInvalidException();
        }

        return new self($code);
    }

    public function value(): string
    {
        return $this->value;
    }
}