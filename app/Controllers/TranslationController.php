<?php

namespace App\Controllers;

use App\Controllers\Controller;

class TranslationController extends Controller

{
    public function switch($request, $response, $args)
    {
        if ( isset($args['lang']) )
        {
            $_SESSION['lang'] = $args['lang'];
        }

        return $response->withRedirect($this->router->pathFor('home'));
    }
}