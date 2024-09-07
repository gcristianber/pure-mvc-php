<?php

namespace App\Controllers;

use App\Core\Controller;

class AuthController extends Controller
{

    /**
     * Renders the login page.
     */
    public function login()
    {
        return view('auth/login');
    }

    /**
     * Validates the input credentials of the user.
     */
    protected function validate() {
        
    }
    
    /**
     * Terminates the session of the user.
     */
    public function logout(){}
}
