<?php

namespace App\Controllers;


use App\Controllers\Controller;
use Respect\Validation\Validator as v;

class Grants_Controller{

	protected $authorisation;

	public function __construct($authorisation){

		$this->authorisation=$authorisation;
	}

	public function getAll($request, $response, $args) {

		$data['error'] = false;
		$data['grants'] = $this->authorisation->getAllGrants();
		return  $response->withJson($data);
	}



}
