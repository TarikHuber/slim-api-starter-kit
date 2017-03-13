<?php

namespace App\Controllers;

use Respect\Validation\Validator as v;
use APILIB\Auth\Authorisation;

class Me_Controller{

	protected $validator;
	protected $error_helper;
	protected $User;
	protected $UsersClients;
	protected $UsersClientsRoles;
	protected $Client;
	protected $id='user_id';
	protected $name_p='users';
	protected $name_s='me';

	public function __construct($User, $UsersClients, $UsersClientsRoles, $Client,   $validator, $error_helper ){

		$this->validator=$validator;
		$this->error_helper=$error_helper;
		$this->User=$User;
		$this->UsersClients=$UsersClients;
		$this->UsersClientsRoles=$UsersClientsRoles;
		$this->Client=$Client;
	}

	private function getValidation($id){

		return [

		];

	}

	private function getTotals(){
		return [];
	}

	private function getVisibleColumns(){
		return ['id','name','email','phone','fax'];
	}


	public function update($request, $response, $args) {

		//$params=$request->getParams();

		$params['name']=$request->getParam('name');

		$validation= $this->validator->validateParams($params,$this->getValidation($request->getAttribute('user_id')));

		if($validation->failed()){
			return $this->error_helper->validationFailed($response,$validation->getErrors());
		}

		if(!$this->User->where('id', $request->getAttribute('user_id'))->update($params)){
			return $this->error_helper->updateFailed($response);
		}

		$data['error']=false;
		$data[$this->name_s]=$this->User->find($request->getAttribute('user_id'));
		return  $response->withJson($data);

	}

	public function changePassword($request, $response, $args) {

		v::with('APILIB\\Validation\\Rules\\');

		$validation= $this->validator->validateParams($request->getParams(),[
			'password'=>v::noWhitespace()->notEmpty(),
			'confirm_password'=>v::noWhitespace()->notEmpty()->confirmPassword($request->getParam('password'))
		]);

		if($validation->failed()){
			return $this->error_helper->validationFailed($response,$validation->getErrors());
		}

		$params['password_hash']=password_hash($request->getParam('password'),PASSWORD_DEFAULT);

		if(!$this->User->where('id', $request->getAttribute('user_id'))->update($params)){
			return $this->error_helper->updateFailed($response);
		}


		$data['error']=false;
		$data[$this->name_s]=$this->User->find($request->getAttribute('user_id'));
		return  $response->withJson($data);

	}

	public function get($request, $response, $args) {

		$data['error'] = false;
		$data[$this->name_s] = $this->User->where('id', $request->getAttribute('user_id'))->first();
		return  $response->withJson($data);

	}

	public function clients($request, $response, $args) {

		$user=$this->User->find($request->getAttribute('user_id'));

		$data['error'] = false;
		$data['totals'] = $this->Client->getTotals($user->clients, $request->getQueryParams(), []);
		$data['my_clients'] = Authorisation::getUserClients($request->getAttribute('user_id'), new \App\Models\User(), new \App\Models\UsersClientsRoles());
		return  $response->withJson($data);

	}


}
