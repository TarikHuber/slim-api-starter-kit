<?php
$app->group('/users_clients', function () {
	$this->post('', 'users_clients_controller:create')->setName('users_clients_create')->add('api_log');
	$this->get('', 'users_clients_controller:get')->setName('users_clients_get');
	$this->get('/{uc_id:[0-9]+}', 'users_clients_controller:find')->setName('users_clients_find');
	$this->delete('/{uc_id:[0-9]+}', 'users_clients_controller:delete')->setName('users_clients_delete')->add('api_log');
})->add('auth');
