<?php

namespace App\Presentation\Controller;

use App\Infrastructure\Persistent\Model\User;

class HomeController
{
    public function index()
    {
        $users = User::all();

        echo '<pre>';
        print_r($users);
        echo '</pre>';
    }
}