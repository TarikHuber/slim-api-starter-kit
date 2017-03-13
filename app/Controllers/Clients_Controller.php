<?php

namespace App\Controllers;

use Respect\Validation\Validator as v;
use APILIB\Controllers\BaseController;

class Clients_Controller extends BaseController{

	protected $id='client_id';
	protected $name_p='clients';
	protected $name_s='client';

	private $settings;

	function __construct($Model, $settings) {
		parent::__construct($Model);
		$this->settings=$settings;
	}

	function getValidation($id){

		return [
			'name'=>v::notEmpty(),
		];

	}



}
