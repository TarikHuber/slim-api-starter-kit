<?php
// DIC configuration
use APILIB\Localisation\Locale as l;

$container = $app->getContainer();

$container['errorHandler'] = function ($c) {
  return function ($request, $response, $exception) use ($c) {

    $data['error'] = true;
    $data['error_id'] = 100001;
    $data['error_message'] = $exception?:l::getMessage('unknown_error');

    return  $response->withJson($data);
  };

};

// Service factory for the ORM
$container['edb'] = function ($container) {
  $capsule = new \Illuminate\Database\Capsule\Manager;
  $capsule->addConnection($container['settings']['db']);

  $capsule->setAsGlobal();
  $capsule->bootEloquent();

  return $capsule;
};

// database
$container['db'] = function ($c) {

  $settings =$c->get('settings')['db'];

  $db=new mysqli($settings['host'], $settings['username'],
  $settings['password'], $settings['name'], $settings['port'], $settings['socket']);

  return $db;
};

$container['error_helper']=function($c){ return new APILIB\Helpers\ErrorHelper();};

$container['validator']=function($c){ return new APILIB\Validation\Validator; };

$container['auth']=function($c){

  //!!!!!!!!!!!!!!!!! IMPORTAND !!!!!!!!!!!!!!!!!!!!!!!!!!!!!
  //Must be called on the first container element needed in application
  $c->get('edb'); //Initiailises the eloquent DB

  return new APILIB\Middleware\AuthMiddleware(
    new \App\Models\User(),
    new \App\Models\Client(),
    new \App\Models\UsersClients(),
    new \App\Models\UsersClientsRoles(),
    $c['settings'],
    $c['error_helper']
  );
};

$container['api_log']=function($c){   return new \App\Middleware\APILogMiddleware(  new \App\Models\APILog(), $c['error_helper'] );};

$container['authentication_controller']=function($c){

  //!!!!!!!!!!!!!!!!! IMPORTAND !!!!!!!!!!!!!!!!!!!!!!!!!!!!!
  //Must be called on the first container element needed in application
  $c->get('edb'); //Initiailises the eloquent DB

  $settings = $c->get('settings');

  return new APILIB\Controllers\Authentication_Controller(
    new \App\Models\User(),
    new \App\Models\UsersClients(),
    new \App\Models\UsersClientsRoles(),
    $c['validator'],
    $c['error_helper'],
    $settings
  );
};

$container['grants_controller']=function($c){ return new \App\Controllers\Grants_Controller($c->get('router')); };

$container['me_controller']=function($c){

  return new \App\Controllers\Me_Controller(
    new \App\Models\User(),
    new \App\Models\UsersClients(),
    new \App\Models\UsersClientsRoles(),
    new \App\Models\Client(),
    $c['validator'],
    $c['error_helper']
  );
};

$container['users_clients_controller']=function($c){

  return new \App\Controllers\UsersClients_Controller(
    new \App\Models\UsersClients(),
    $c['validator'],
    $c['error_helper']
  );
};

$container['clients_controller']=function($c){
  $settings = $c->get('settings')['file_upload'];
  return new \App\Controllers\Clients_Controller( new \App\Models\Client(), $settings );
};

$container['items_controller']=function($c){
  return new \App\Controllers\Items_Controller( new \App\Models\Item());
};

$container['api_log_controller']=function($c){
  return new \App\Controllers\APILog_Controller( new \App\Models\APILog());
};

$container['users_clients_roles_controller']=function($c){
  return new \App\Controllers\UsersClientsRoles_Controller( new \App\Models\UsersClientsRoles());
};

$container['users_controller']=function($c){
  return new \App\Controllers\Users_Controller( new \App\Models\User());
};

$container['roles_controller']=function($c){
  return new \App\Controllers\Roles_Controller( new \App\Models\Role());
};
