<?php

namespace App\Validation\Exceptions;

use Respect\Validation\Exceptions\ValidationException;


class ItemNumberExistsException extends ValidationException
{

	public static $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => '{{name}} is already in use',
        ],
        self::MODE_NEGATIVE => [
            self::STANDARD => '{{name}} must not be in use',
        ]
    ];

}
