<?php

namespace App\Validation\Exceptions;

use Respect\Validation\Exceptions\ValidationException;

class EANException extends ValidationException
{

	public static $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => '{{name}} is not a valid EAN',
        ],
        self::MODE_NEGATIVE => [
            self::STANDARD => '{{name}} must not be a valid EAN',
        ]
    ];



}
