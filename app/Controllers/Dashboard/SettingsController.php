<?php

namespace App\Controllers\Dashboard;

use App\Controllers\Controller;

class SettingsController extends Controller

{
    public function index($request, $response)
    {
        return $this->view->render($response, 'dashboard/settings.twig');
    }
}