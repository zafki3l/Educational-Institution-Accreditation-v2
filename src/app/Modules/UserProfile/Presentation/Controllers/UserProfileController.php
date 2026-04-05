<?php

namespace App\Modules\UserProfile\Presentation\Controllers;

use App\Shared\Web\Http\HttpResponse;

abstract class UserProfileController
{
    use HttpResponse;

    public const MODULE_NAME = 'UserProfile';
}