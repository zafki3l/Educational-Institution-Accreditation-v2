<?php

namespace App\Modules\UserManagement\Domain\ValueObjects;

use App\Modules\UserManagement\Domain\Exception\InvalidEmailFormatException;

final class Email
{
    private ?string $value;

    private function __construct(?string $value)
    {
        $this->value = $value;
    }

    public static function fromString(string $email): self
    {
        $email = trim(strtolower($email));

        self::validate($email);

        return new self($email);
    }

    private static function validate(?string $email): void
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidEmailFormatException();
        }
    }

    public function value(): ?string
    {
        return $this->value;
    }

    public function equals(self $other): bool
    {
        return $this->value === $other->value;
    }
}