<?php

namespace App\Modules\UserManagement\Domain\ValueObjects;

use App\Modules\UserManagement\Domain\Exception\PasswordEmptyException;
use App\Modules\UserManagement\Domain\Exception\PasswordInvalidFormatException;
use App\Modules\UserManagement\Domain\Exception\PasswordTooShortException;

class Password
{
    private const MINIMIUM_LENGTH = 8;

    private string $hash;

    private function __construct(string $hash)
    {
        $this->hash = $hash;
    }

    public static function fromPlain(string $plain): self
    {
        if (self::isEmpty($plain)) {
            throw new PasswordEmptyException();
        }

        $plain = trim($plain);
        
        self::checkMinimiumLength($plain);

        self::checkPasswordContainsCharacterAndNumber($plain);

        return new self(password_hash($plain, PASSWORD_DEFAULT));
    }

    public static function isEmpty($plain): bool
    {
        return empty($plain);
    }

    private static function checkMinimiumLength(string $plain): void
    {
        if (strlen($plain) < self::MINIMIUM_LENGTH) {
            throw new PasswordTooShortException();
        }
    }

    private static function checkPasswordContainsCharacterAndNumber(string $plain)
    {
        if (!preg_match('/[A-Za-z]/', $plain) || !preg_match('/\d/', $plain)) {
            throw new PasswordInvalidFormatException();
        }
    }

    public static function fromHash(string $hash): self
    {
        return new self($hash);
    }

    public function verify(string $plain): bool
    {
        return password_verify($plain, $this->hash);
    }

    public function value(): string
    {
        return $this->hash;
    }
}