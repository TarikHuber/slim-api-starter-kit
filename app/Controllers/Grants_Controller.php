<?php

namespace App\Controllers;


use App\Controllers\Controller;
use Respect\Validation\Validator as v;
use APILIB\Auth\Authorisation;

class Grants_Controller{

	protected $router;

	public function __construct($router){

		$this->router=$router;
	}

	public function getAll($request, $response, $args) {

		$data['error'] = false;
		$data['grants'] = Authorisation::getAllGrants($this->router);
		return  $response->withJson($data);
	}

}
