<?php

namespace App\Validation\Rules;

use Respect\Validation\Rules\AbstractRule;

class PasswordConfirm extends AbstractRule

{
    public function validate($input)
    {
        return ($input == $_POST['password_confirm']) ? true : false;
    }
}