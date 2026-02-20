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
        $user = AuthenticableUser::create(UserId::generate(), AuthId::generate(), Password::fromPlain('password123'), 2);

        $this->assertTrue($user->verify('password123'), 'TRUE');
    }

    public function testVerifyFalse(): void
    {
        $user = AuthenticableUser::create(UserId::generate(), AuthId::generate(), Password::fromPlain('password123'), 2);

        $this->assertFalse($user->verify('wrongPass456'), 'FAILURE');
    }
}