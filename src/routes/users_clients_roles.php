<?php
$app->group('/users_clients_roles', function () {
	$this->post('', 'users_clients_roles_controller:create')->setName('users_clients_roles_create')->add('api_log');
	$this->get('', 'users_clients_roles_controller:get')->setName('users_clients_roles_get');
	$this->get('/{ucr_id:[0-9]+}', 'users_clients_roles_controller:find')->setName('users_clients_roles_find');
	$this->delete('/{ucr_id:[0-9]+}', 'users_clients_roles_controller:delete')->setName('users_clients_roles_delete')->add('api_log');
})->add('auth');
