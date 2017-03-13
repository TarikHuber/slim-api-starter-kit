<?php

namespace App\Controllers;

use Respect\Validation\Validator as v;
use APILIB\Controllers\BaseController;

class Users_Controller extends BaseController{

	protected $id='user_id';
	protected $name_p='users';
	protected $name_s='user';

	function getValidation($id){

		return [
			'name'=>v::notEmpty()
		];

	}

	function getVisibleColumns(){
		return ['id','created_at','updated_at','name','email','phone','fax','active','admin'];
	}

	public function changePassword($request, $response, $args) {


		$id=$args[$this->id];

		v::with('APILIB\\Validation\\Rules\\');

		$validation= $this->validator->validateParams($request->getParams(),[
			'password'=>v::noWhitespace()->notEmpty(),
			'confirm_password'=>v::noWhitespace()->notEmpty()->confirmPassword($request->getParam('password'))
		]);

		if($validation->failed()){
			return $this->error_helper->validationFailed($response,$validation->getErrors());
		}

		$params['password_hash']=password_hash($request->getParam('password'),PASSWORD_DEFAULT);

		if(!$this->Model->where('id', $id)->update($params)){
			return $this->error_helper->updateFailed($response);
		}


		$data['error']=false;
		$data[$this->name_s]=$this->Model->find($id);
		return  $response->withJson($data);

	}

}
