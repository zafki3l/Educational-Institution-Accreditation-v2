<?php

namespace Tests\Unit\Modules\UserManagement\Domain\ValueObjects;

use App\Modules\UserManagement\Domain\ValueObjects\Password;
use App\Modules\UserManagement\Domain\Exception\PasswordEmptyException;
use App\Modules\UserManagement\Domain\Exception\PasswordTooShortException;
use App\Modules\UserManagement\Domain\Exception\PasswordInvalidFormatException;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;

final class PasswordTest extends TestCase
{
    public function testCreatePasswordFromValidPlainText(): void
    {
        $plain = 'SafePass123';
        $password = Password::fromPlain($plain);

        $this->assertInstanceOf(Password::class, $password);
        $this->assertNotEquals($plain, $password->value());
        $this->assertTrue($password->verify($plain));
        $this->assertFalse($password->verify('WrongPass123'));
    }

    public function testCreateFromExistingHash(): void
    {
        $hash = password_hash('existingHash123', PASSWORD_DEFAULT);
        $password = Password::fromHash($hash);

        $this->assertEquals($hash, $password->value());
        $this->assertTrue($password->verify('existingHash123'));
    }

    public function testThrowsExceptionIfPasswordIsEmpty(): void
    {
        $this->expectException(PasswordEmptyException::class);
        Password::fromPlain('');
    }

    public function testThrowsExceptionIfPasswordContainsOnlySpaces(): void
    {
        $this->expectException(PasswordTooShortException::class);
        Password::fromPlain('   ');
    }

    public function testThrowsExceptionIfPasswordIsTooShort(): void
    {
        $this->expectException(PasswordTooShortException::class);
        Password::fromPlain('Abc1234');
    }

    #[DataProvider('invalidFormatProvider')]
    public function testThrowsExceptionForInvalidFormat(string $invalidPlain): void
    {
        $this->expectException(PasswordInvalidFormatException::class);
        Password::fromPlain($invalidPlain);
    }

    public static function invalidFormatProvider(): array
    {
        return [
            ['123456789'],
            ['abcdefghijk'],
            ['!@#$%^&*()_+'],
        ];
    }
}