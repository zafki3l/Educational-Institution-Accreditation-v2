<?php

namespace Tests\Unit\Modules\UserManagement\Domain\Entities;

use App\Modules\UserManagement\Domain\Entities\User;
use App\Modules\UserManagement\Domain\ValueObjects\UserId;
use App\Modules\UserManagement\Domain\ValueObjects\Email;
use App\Modules\UserManagement\Domain\ValueObjects\Password;
use App\Modules\UserManagement\Domain\Exception\UserNameEmptyException;
use App\Modules\UserManagement\Domain\Exception\RoleMissingException;
use PHPUnit\Framework\TestCase;

final class UserTest extends TestCase
{
    private const VALID_UUID = 'f47ac10b-58cc-4372-a567-0e02b2c3d479';

    private function createValidUser(): User
    {
        return User::create(
            UserId::fromString(self::VALID_UUID),
            'Nguyen',
            'An',
            Email::fromString('an@example.com'),
            Password::fromPlain('SafePass123'),
            1,
            'dept-001'
        );
    }

    public function testCreateWithValidData(): void
    {
        $user = $this->createValidUser();

        $this->assertEquals('Nguyen An', $user->getFullName());
        $this->assertEquals(1, $user->getRoleId());
        $this->assertInstanceOf(Email::class, $user->getEmail());
        $this->assertEquals('an@example.com', $user->getEmail()->value());
    }

    public function testThrowsExceptionWhenFirstNameIsEmpty(): void
    {
        $this->expectException(UserNameEmptyException::class);

        User::create(
            UserId::fromString(self::VALID_UUID),
            '',
            'An',
            Email::fromString('an@example.com'),
            Password::fromPlain('SafePass123'),
            1,
            null
        );
    }

    public function testUpdateUserInfo(): void
    {
        $user = $this->createValidUser();
        $newEmail = Email::fromString('binh.new@example.com');

        $user->update(
            'Tran',
            'Binh',
            $newEmail,
            2,
            'dept-999'
        );

        $this->assertEquals('Tran Binh', $user->getFullName());
        $this->assertEquals('binh.new@example.com', $user->getEmail()->value());
        $this->assertEquals(2, $user->getRoleId());
        
        $changes = $user->getChanges();
        $this->assertArrayHasKey('first_name', $changes);
        $this->assertEquals('Nguyen', $changes['first_name']['old']);
        $this->assertEquals('Tran', $changes['first_name']['new']);
    }

    public function testUpdateDoesNotRecordChangesWhenDataIsSame(): void
    {
        $user = $this->createValidUser();
        
        $user->update(
            'Nguyen',
            'An',
            Email::fromString('an@example.com'),
            1,
            'dept-001'
        );

        $this->assertEmpty($user->getChanges());
    }

    public function testThrowsExceptionIfRoleIdIsZeroInCreate(): void
    {
        $this->expectException(RoleMissingException::class);
        
        User::create(
            UserId::fromString(self::VALID_UUID),
            'Nguyen',
            'An',
            Email::fromString('an@example.com'),
            Password::fromPlain('SafePass123'),
            0,
            null
        );
    }

    public function testChangeRoleIdDirectly(): void
    {
        $user = $this->createValidUser();
        $user->changeRoleId(5);
        
        $this->assertEquals(5, $user->getRoleId());
    }
}