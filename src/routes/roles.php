<?php

$app->group('/roles', function () {
	$this->post('', 'roles_controller:create')->setName('roles_create')->add('api_log');
	$this->put('/{role_id:[0-9]+}', 'roles_controller:update')->setName('roles_update')->add('api_log');
	$this->get('', 'roles_controller:get')->setName('roles_get');
	$this->get('/{role_id:[0-9]+}', 'roles_controller:find')->setName('roles_find');
	$this->delete('/{role_id:[0-9]+}', 'roles_controller:delete')->setName('roles_delete')->add('api_log');
})->add('auth');
