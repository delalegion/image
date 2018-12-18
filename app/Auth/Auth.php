<?php

namespace App\Auth;

use App\Models\User;

class Auth
{

    public function user()

    {
        if ( isset($_SESSION['logInId']) )
        {
            return User::find($_SESSION['logInId']);
        }
    }

    public function check()

    {
        return isset($_SESSION['logInTrue']);
    }

    public function attempt($email, $password)

    {
        $user = User::where('email', $email)->first();

        if (!$user)
        {
            return false;
        }

        if ( password_verify($password, $user->password) )
        {
            $_SESSION['logInTrue'] = true;
            $_SESSION['logInId'] = $user->id;

            return true;
        }

        return false;
    }

}