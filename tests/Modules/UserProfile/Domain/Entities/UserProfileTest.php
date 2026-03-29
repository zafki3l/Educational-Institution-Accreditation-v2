<?php

namespace Tests\Unit\Modules\UserProfile\Domain\Entities;

use App\Modules\UserProfile\Domain\Entities\UserProfile;
use App\Modules\UserProfile\Domain\Exceptions\UserIdEmptyException;
use App\Modules\UserProfile\Domain\Exceptions\UserNameEmptyException;
use PHPUnit\Framework\TestCase;

class UserProfileTest extends TestCase
{
    public function testCanBeCreatedSuccessfully(): void
    {
        $id = 'user-123';
        $firstName = 'Nguyen';
        $lastName = 'An';
        $email = 'an@gmail.com';

        $profile = UserProfile::create($id, $firstName, $lastName, $email);

        $this->assertEquals($id, $profile->getId());
        $this->assertEquals($firstName, $profile->getFirstName());
        $this->assertEquals($lastName, $profile->getLastName());
        $this->assertEquals($email, $profile->getEmail());
        $this->assertNull($profile->getPassword());
    }

    public function testThrowsExceptionIfIdIsEmpty(): void
    {
        $this->expectException(UserIdEmptyException::class);
        UserProfile::create('', 'Nguyen', 'An', 'an@gmail.com');
    }

    public function testThrowsExceptionIfBothNamesAreEmpty(): void
    {
        $this->expectException(UserNameEmptyException::class);
        UserProfile::create('id-1', '', '', 'an@gmail.com');
    }

    public function testCanBeReconstitutedFromPersistence(): void
    {
        $id = 'id-1';
        $fname = 'Nguyen';
        $lname = 'An';
        $email = 'an@gmail.com';
        $hashedPass = 'hashed_123';

        $profile = UserProfile::fromPersistent($id, $fname, $lname, $email, $hashedPass);

        $this->assertEquals($email, $profile->getEmail());
        $this->assertEquals($hashedPass, $profile->getPassword());
    }

    public function testUpdateInformationAndTrackChanges(): void
    {
        $profile = UserProfile::create('id-1', 'Nguyen', 'An', 'old@gmail.com');
        
        $newFirstName = 'Tran';
        $newEmail = 'new@gmail.com';

        $profile->update($newFirstName, 'An', $newEmail);

        $this->assertEquals($newFirstName, $profile->getFirstName());
        $this->assertEquals($newEmail, $profile->getEmail());
        
        $changes = $profile->getChanges();
        
        $this->assertArrayHasKey('first_name', $changes);
        $this->assertEquals('Nguyen', $changes['first_name']['old']);
        $this->assertEquals('Tran', $changes['first_name']['new']);

        $this->assertArrayHasKey('email', $changes);
        $this->assertEquals('old@gmail.com', $changes['email']['old']);
        $this->assertEquals('new@gmail.com', $changes['email']['new']);

        $this->assertArrayNotHasKey('last_name', $changes);
    }

    public function testChangePassword(): void
    {
        $profile = UserProfile::create('id-1', 'Nguyen', 'An', 'an@gmail.com');
        $newHashedPassword = 'new_hashed_password';

        $profile->changePassword($newHashedPassword);

        $this->assertEquals($newHashedPassword, $profile->getPassword());
    }

    public function testHasChangesReturnsCorrectValue(): void
    {
        $profile = UserProfile::create('id-1', 'Nguyen', 'An', 'an@gmail.com');
        
        $this->assertFalse($profile->hasChanges());

        $profile->update('Nguyen', 'An', 'new-email@gmail.com');
        
        $this->assertTrue($profile->hasChanges());
    }
}