<?php

namespace App\Controllers;

use Respect\Validation\Validator as v;
use APILIB\Controllers\BaseController;

class APILog_Controller extends BaseController{

	protected $id='api_log_id';
	protected $name_p='api_logs';
	protected $name_s='api_log';
	protected $createWithClientID=true;

	function findChildData($query){
		return $query->with(['client','user']);
	}

	function getChildData($query){
		return $query->with(['client','user']);
	}

}
