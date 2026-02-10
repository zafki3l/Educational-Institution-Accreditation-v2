<?php

declare(strict_types=1);

namespace Tests\Unit\Modules\UserManagement\Entities;

use App\Modules\Authentication\Domain\ValueObjects\AuthId;
use App\Modules\UserManagement\Domain\Entities\User;
use App\Modules\UserManagement\Domain\ValueObjects\Email;
use App\Modules\UserManagement\Domain\ValueObjects\Password;
use App\Modules\UserManagement\Domain\ValueObjects\UserId;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    private UserId $userId;
    private AuthId $authId;
    private Password $password;

    protected function setUp(): void
    {
        $this->userId = UserId::generate();
        $this->authId = AuthId::generate();
        $this->password = Password::fromPlain('password123');
    }

    public function testCreateNewUser(): void
    {
        $user = User::create(
            $this->userId,
            $this->authId,
            'John',
            'Doe',
            $this->password,
            1
        );

        $this->assertInstanceOf(User::class, $user);
    }

    public function testGetUserId(): void
    {
        $user = User::create(
            $this->userId,
            $this->authId,
            'John',
            'Doe',
            $this->password,
            1
        );

        $this->assertTrue($user->getUserId()->equals($this->userId));
    }

    public function testGetAuthId(): void
    {
        $user = User::create(
            $this->userId,
            $this->authId,
            'John',
            'Doe',
            $this->password,
            1
        );

        $this->assertTrue($this->authId->equals($user->getAuthId()));
    }

    public function testGetFirstName(): void
    {
        $user = User::create(
            $this->userId,
            $this->authId,
            'John',
            'Doe',
            $this->password,
            1
        );

        $this->assertEquals('John', $user->getFirstName());
    }

    public function testGetLastName(): void
    {
        $user = User::create(
            $this->userId,
            $this->authId,
            'John',
            'Doe',
            $this->password,
            1
        );

        $this->assertEquals('Doe', $user->getLastName());
    }

    public function testGetFullName(): void
    {
        $user = User::create(
            $this->userId,
            $this->authId,
            'John',
            'Doe',
            $this->password,
            1
        );

        $this->assertEquals('John Doe', $user->getFullName());
    }

    public function testGetEmailReturnsNullWhenNotSet(): void
    {
        $user = User::create(
            $this->userId,
            $this->authId,
            'John',
            'Doe',
            $this->password,
            1
        );

        $this->assertNull($user->getEmail());
    }

    public function testGetPassword(): void
    {
        $user = User::create(
            $this->userId,
            $this->authId,
            'John',
            'Doe',
            $this->password,
            1
        );

        $this->assertEquals($this->password->value(), $user->getPassword()->value());
    }

    public function testGetRoleId(): void
    {
        $user = User::create(
            $this->userId,
            $this->authId,
            'John',
            'Doe',
            $this->password,
            2
        );

        $this->assertEquals(2, $user->getRoleId());
    }

    public function testChangeFirstName(): void
    {
        $user = User::create(
            $this->userId,
            $this->authId,
            'John',
            'Doe',
            $this->password,
            1
        );

        $user->changeFirstName('Jane');

        $this->assertEquals('Jane', $user->getFirstName());
    }

    public function testChangeLastName(): void
    {
        $user = User::create(
            $this->userId,
            $this->authId,
            'John',
            'Doe',
            $this->password,
            1
        );

        $user->changeLastName('Smith');

        $this->assertEquals('Smith', $user->getLastName());
    }

    public function testAssignEmail(): void
    {
        $user = User::create(
            $this->userId,
            $this->authId,
            'John',
            'Doe',
            $this->password,
            1
        );

        $email = Email::fromString('john@example.com');
        $user->assignEmail($email);

        $this->assertTrue($email->equals($user->getEmail()));
    }

    public function testChangePassword(): void
    {
        $user = User::create(
            $this->userId,
            $this->authId,
            'John',
            'Doe',
            $this->password,
            1
        );

        $newPassword = Password::fromPlain('newpassword123');
        $user->changePassword($newPassword);

        $this->assertEquals($newPassword->value(), $user->getPassword()->value());
    }

    public function testChangeRole(): void
    {
        $user = User::create(
            $this->userId,
            $this->authId,
            'John',
            'Doe',
            $this->password,
            1
        );

        $user->changeRole(3);

        $this->assertEquals(3, $user->getRoleId());
    }

    public function testChangeAuthId(): void
    {
        $user = User::create(
            $this->userId,
            $this->authId,
            'John',
            'Doe',
            $this->password,
            1
        );

        $newAuthId = AuthId::generate();
        $user->changeAuthId($newAuthId);

        $this->assertTrue($newAuthId->equals($user->getAuthId()));
    }

    public function testUpdateFirstNameAndLastName(): void
    {
        $user = User::create(
            $this->userId,
            $this->authId,
            'John',
            'Doe',
            $this->password,
            1
        );

        $user->update('Jane', 'Smith', null, 2);

        $this->assertEquals('Jane', $user->getFirstName());
        $this->assertEquals('Smith', $user->getLastName());
        $this->assertEquals(2, $user->getRoleId());
    }

    public function testUpdateWithEmail(): void
    {
        $user = User::create(
            $this->userId,
            $this->authId,
            'John',
            'Doe',
            $this->password,
            1
        );

        $user->update('John', 'Doe', 'john@example.com', 1);

        $this->assertNotNull($user->getEmail());
        $this->assertEquals('john@example.com', $user->getEmail()->value());
    }

    public function testUpdateWithNullEmail(): void
    {
        $user = User::create(
            $this->userId,
            $this->authId,
            'John',
            'Doe',
            $this->password,
            1
        );

        $email = Email::fromString('john@example.com');
        $user->assignEmail($email);

        // Update with null email should not change existing email
        $user->update('John', 'Doe', null, 1);

        $this->assertEquals('john@example.com', $user->getEmail()->value());
    }

    public function testUpdateAllFields(): void
    {
        $user = User::create(
            $this->userId,
            $this->authId,
            'John',
            'Doe',
            $this->password,
            1
        );

        $user->update('Jane', 'Smith', 'jane@example.com', 3);

        $this->assertEquals('Jane', $user->getFirstName());
        $this->assertEquals('Smith', $user->getLastName());
        $this->assertEquals('jane@example.com', $user->getEmail()->value());
        $this->assertEquals(3, $user->getRoleId());
    }
}
