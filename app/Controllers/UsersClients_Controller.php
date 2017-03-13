<?php

namespace App\Controllers;

use Respect\Validation\Validator as v;
use APILIB\Controllers\BaseController;

class UsersClients_Controller extends BaseController{

	protected $id='uc_id';
	protected $name_p='users_clients';
	protected $name_s='users_clients';

	function getChildData($query){
		return $query->with('client');
	}

}
