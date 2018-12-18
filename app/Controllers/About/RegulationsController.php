<?php

namespace App\Controllers\About;

use App\Controllers\Controller;

class RegulationsController extends Controller

{
    public function index($request, $response, $args)
    {
        return $this->view->render($response, 'about/regulations.twig');
    }
}