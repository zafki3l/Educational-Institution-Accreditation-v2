<?php

declare(strict_types=1);

namespace Tests\Unit\Modules\UserManagement\ValueObjects;

use App\Modules\UserManagement\Domain\ValueObjects\Password;
use PHPUnit\Framework\TestCase;

class PasswordTest extends TestCase
{
    public function testCreateFromPlainPassword(): void
    {
        $plainPassword = 'securePass123';

        $password = Password::fromPlain($plainPassword);

        $this->assertInstanceOf(Password::class, $password);
    }

    public function testCreateFromHashedPassword(): void
    {
        $hashedPassword = password_hash('securePass123', PASSWORD_DEFAULT);

        $password = Password::fromHash($hashedPassword);

        $this->assertInstanceOf(Password::class, $password);
    }

    public function testPasswordValueReturnsString(): void
    {
        $password = Password::fromPlain('testPass123');

        $this->assertIsString($password->value());
    }

    public function testVerifyReturnsTrueWithCorrectPassword(): void
    {
        $plainPassword = 'securePass123';

        $password = Password::fromPlain($plainPassword);

        $this->assertTrue($password->verify($plainPassword));
    }

    public function testVerifyReturnsFalseWithIncorrectPassword(): void
    {
        $plainPassword = 'securePass123';
        $wrongPassword = 'wrongPass456';

        $password = Password::fromPlain($plainPassword);

        $this->assertFalse($password->verify($wrongPassword));
    }

    public function testPlainPasswordIsHashed(): void
    {
        $plainPassword = 'securePass123';

        $password = Password::fromPlain($plainPassword);

        // Hash should not be the same as plain password
        $this->assertNotEquals($plainPassword, $password->value());
    }

    public function testDifferentPlainPasswordsGenerateDifferentHashes(): void
    {
        $password1 = Password::fromPlain('password123');
        $password2 = Password::fromPlain('password123');

        // Different calls to fromPlain will generate different hashes
        // (due to random salt in PASSWORD_DEFAULT)
        $this->assertNotEquals($password1->value(), $password2->value());
    }

    public function testVerifyWithHashedPasswordFromPlain(): void
    {
        $plainPassword = 'testPass123';
        $password = Password::fromPlain($plainPassword);

        $this->assertTrue($password->verify($plainPassword));
    }

    public function testVerifyWithDifferentHashedPassword(): void
    {
        $hash = password_hash('originalPass123', PASSWORD_DEFAULT);
        $password = Password::fromHash($hash);

        $this->assertFalse($password->verify('diffPass456'));
    }

    public function testEmptyPasswordThrowsException(): void
    {
        $this->expectException(\App\Modules\UserManagement\Domain\Exception\PasswordEmptyException::class);

        Password::fromPlain('');
    }

    public function testComplexPasswordCanBeHashed(): void
    {
        $complexPassword = 'P@ssw0rd!#$%^&*()_+-=[]{}|;:,.<>?';

        $password = Password::fromPlain($complexPassword);

        $this->assertTrue($password->verify($complexPassword));
    }
}
