<?php

namespace App\Controllers\About;

use App\Models\User;
use App\Controllers\Controller;

class UsersController extends Controller

{
    public function index($request, $response, $args)
    {
        $users = User::where('id', $args['user'])->first();

        if ($users)
        {
            $usersData = [
                'user' => [
                    'id' => $users->id,
                    'name' => $users->name,
                    'email' => $users->email,
                    'password' => $users->password,
                    'regulations' => $users->regulations
                ]
            ];

            return $this->view->render($response, 'about/users.twig', $usersData);
        }

        return $this->view->render($response, 'about/users.twig');
    }
}