<?php

namespace App\Controllers;

use Respect\Validation\Validator as v;
use APILIB\Controllers\BaseController;

class UsersClientsRoles_Controller extends BaseController{

	protected $id='ucr_id';
	protected $name_p='users_clients_roles';
	protected $name_s='users_clients_role';

	function getChildData($query){
		return $query->with(['role','client','user']);
	}

}
