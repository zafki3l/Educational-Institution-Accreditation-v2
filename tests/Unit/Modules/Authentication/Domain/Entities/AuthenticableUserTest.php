<?php

namespace Tests\Unit\Modules\Authentication\Domain\Entities;

use App\Modules\Authentication\Domain\Entities\AuthenticableUser;
use App\Modules\Authentication\Domain\ValueObjects\AuthId;
use App\Modules\UserManagement\Domain\ValueObjects\Password;
use App\Modules\UserManagement\Domain\ValueObjects\UserId;
use PHPUnit\Framework\TestCase;

class AuthenticableUserTest extends TestCase
{
    public function testVerifyTrue(): void
    {
        $user = AuthenticableUser::create(UserId::generate(), AuthId::generate(), Password::fromPlain('12345'), 2);

        $this->assertTrue($user->verify('12345'), 'TRUE');
    }

    public function testVerifyFalse(): void
    {
        $user = AuthenticableUser::create(UserId::generate(), AuthId::generate(), Password::fromPlain('12345'), 2);

        $this->assertFalse($user->verify('123456'), 'FAILURE');
    }
}