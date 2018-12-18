<?php

namespace App\Validation\Exceptions;

use Respect\Validation\Exceptions\ValidationException;

class PasswordConfirmException extends ValidationException

{
    public static $defaultTemplates = [
        self::MODE_DEFAULT =>   [
            self::STANDARD =>   'Passwords must be the same.',
        ],
    ];
}