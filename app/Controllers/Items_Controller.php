<?php

namespace App\Controllers;

use Respect\Validation\Validator as v;
use APILIB\Controllers\BaseController;
use APILIB\Auth\Authorisation;
use APILIB\Helpers\EmailHelper;

class Items_Controller extends BaseController{

	protected $id='item_id';
	protected $name_p='items';
	protected $name_s='item';
	protected $createWithClientID=true;

	public function getValidation($id){

		$client=Authorisation::getClient();

		return [
			'name'=>v::notEmpty()->itemNameExists($id),
			'number'=>v::notEmpty()->itemNumberExists($id),
			'ean'=>v::notEmpty()->EAN()->itemEANExists($id),
			'factor'=>v::optional(v::numeric()),
		];

	}

}
