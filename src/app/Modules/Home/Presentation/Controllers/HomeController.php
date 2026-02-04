<?php

namespace App\Modules\Home\Presentation\Controllers;

use App\Shared\Http\Traits\HttpResponse;
use Core\Controller;

class HomeController extends Controller
{
    use HttpResponse;

    public function index()
    {
        return $this->view('home', 'main.layouts');
    }

    public function click()
    {
        return $this->view('clickme', 'main.layouts');
    }

    public function process()
    {
        $this->redirect('/');
    }
}