<?php

namespace App\Middleware;

use APILIB\Auth\Authorisation;
use \App\Models\APILog;

class APILogMiddleware {

	protected $apilog_model;
	protected $error_helper;

	public function __construct($apilog_model, $error_helper){

		$this->apilog_model=$apilog_model;
		$this->error_helper=$error_helper;
	}

	public function __invoke($request, $response, $next){

		$response = $next($request, $response);

		//Log the api call if no error occured
		if(!$this->error_helper->getInvoked()){
			$route = $request->getAttribute('route');

			$params['user_id']=Authorisation::getUser()['id'];
			$params['client_id']=Authorisation::getClient()['id'];
			$params['api_call']=$route->getName();
			$params['method']=$request->getMethod();
			$params['args']= $request->getMethod()=='POST'?json_encode(['id'=>$response->getHeaderLine('insert_id')]):json_encode($route->getArguments());
			$params['params']=json_encode($request->getParams());

			$created_id = $this->apilog_model->insertGetId($params);
		}

		return $response;

	}


}
