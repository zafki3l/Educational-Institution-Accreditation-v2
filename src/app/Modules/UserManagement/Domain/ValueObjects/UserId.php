<?php

namespace App\Modules\UserManagement\Domain\ValueObjects;

class UserId
{
    private string $value;

    private function __construct(string $value)
    {
        $this->value = $value;
    }

    public static function generate(): self
    {
        $data = random_bytes(16);

        // version 4
        $data[6] = chr((ord($data[6]) & 0x0f) | 0x40);
        // variant RFC 4122
        $data[8] = chr((ord($data[8]) & 0x3f) | 0x80);

        $hex = bin2hex($data);

        $uuid = vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split($hex, 4));

        return new self($uuid);
    }

    public static function fromString(string $value): self
    {
        if (!self::isValid($value)) {
            throw new \InvalidArgumentException("Invalid UUID");
        }

        return new self(strtolower($value));
    }

    public static function isValid(string $value): bool
    {
        return preg_match(
            '/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/i',
            $value
        ) === 1;
    }

    public function value(): string
    {
        return $this->value;
    }

    public function equals(UserId $other): bool
    {
        return $this->value === $other->value;
    }
}