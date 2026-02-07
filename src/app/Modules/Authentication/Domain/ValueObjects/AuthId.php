<?php

namespace App\Modules\Authentication\Domain\ValueObjects;

final class AuthId 
{
    private string $value;

    private function __construct(string $value) {
        $this->value = $value;
    }

    public static function generate(): self
    {
        return new self(bin2hex(random_bytes(16)));
    }

    public static function fromString(string $id): self {
        return new self($id);
    }

    public function value(): string {
        return $this->value;
    }
}