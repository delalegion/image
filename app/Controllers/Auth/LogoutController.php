<?php

namespace App\Controllers\Auth;

use App\Controllers\Controller;

class LogoutController extends Controller

{
    public function index($request, $response)
    {
        unset($_SESSION['logInTrue']);
        unset($_SESSION['logInName']);

        return $response->withRedirect($this->router->pathFor('auth.signin'));
    }
}