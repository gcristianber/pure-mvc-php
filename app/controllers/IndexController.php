<?php

namespace App\Controllers;

use App\Core\Controller;

class IndexController extends Controller
{

    public function index(): void
    {
        $this->view('index');
    }
}
