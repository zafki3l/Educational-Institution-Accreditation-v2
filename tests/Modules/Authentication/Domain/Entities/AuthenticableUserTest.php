<?php

namespace Tests\Modules\Authentication\Domain\Entities;

use App\Modules\Authentication\Domain\Entities\AuthenticableUser;
use App\Modules\UserManagement\Domain\ValueObjects\Password;
use App\Modules\UserManagement\Domain\ValueObjects\UserId;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;

final class AuthenticableUserTest extends TestCase
{
    private const VALID_UUID = '550e8400-e29b-41d4-a716-446655440000';
    private const VALID_EMAIL = 'test@example.com';
    private const PLAIN_PASSWORD = 'password123';
    private const DEFAULT_ROLE_ID = 2;

    private AuthenticableUser $user;
    private UserId $userId;

    protected function setUp(): void
    {
        $this->userId = UserId::fromString(self::VALID_UUID);
        $password = Password::fromPlain(self::PLAIN_PASSWORD);

        $this->user = AuthenticableUser::create(
            $this->userId,
            self::VALID_EMAIL,
            $password,
            self::DEFAULT_ROLE_ID
        );
    }

    public function testInitializationWithValidData(): void
    {
        $this->assertTrue($this->user->getUserId()->equals($this->userId));
        $this->assertSame(self::VALID_EMAIL, $this->user->getIdentifier());
        $this->assertSame(self::DEFAULT_ROLE_ID, $this->user->getRoleId());
        $this->assertInstanceOf(AuthenticableUser::class, $this->user);
    }

    #[DataProvider('providePasswordCases')] 
    public function testPasswordVerificationLogic(string $inputPassword, bool $expectedResult): void
    {
        $result = $this->user->verify($inputPassword);
        
        $this->assertSame(
            $expectedResult, 
            $result, 
            "Failed verification for input: '$inputPassword'"
        );
    }

    public static function providePasswordCases(): array
    {
        return [
            'valid password' => [self::PLAIN_PASSWORD, true],
            'invalid password' => ['wrong_password_xyz', false],
            'empty password' => ['', false],
            'password with whitespace' => [' ' . self::PLAIN_PASSWORD . ' ', false],
            'case sensitive check' => [strtoupper(self::PLAIN_PASSWORD), false],
        ];
    }
}