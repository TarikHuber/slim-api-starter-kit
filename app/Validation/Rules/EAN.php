<?php


namespace App\Validation\Rules;


use Respect\Validation\Rules\AbstractRule;
use Respect\Validation\Validator as v;

class EAN extends AbstractRule
{

	public function validate($input)
	{

		//TO DO: Add validation by checksum with lenght of 14

		 return v::digit()->length(14, 14)->validate($input);

	}

}
