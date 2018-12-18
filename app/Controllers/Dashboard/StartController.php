<?php

namespace App\Controllers\Dashboard;

use App\Controllers\Controller;

class StartController extends Controller

{
    public function index($request, $response)
    {
        return $this->view->render($response, 'dashboard/start.twig');
    }
}