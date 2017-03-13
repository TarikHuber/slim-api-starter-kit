<?php

$app->group('/clients', function () {
	$this->post('', 'clients_controller:create')->setName('clients_create')->add('api_log');
	$this->post('/{client_id:[0-9]+}/set_logo', 'clients_controller:setLogo')->setName('clients_set_logo')->add('api_log');
	$this->put('/{client_id:[0-9]+}', 'clients_controller:update')->setName('clients_update')->add('api_log');
	$this->get('', 'clients_controller:get')->setName('clients_get');
	$this->get('/{client_id:[0-9]+}', 'clients_controller:find')->setName('clients_find');
	$this->get('/{client_id:[0-9]+}/view_logo', 'clients_controller:viewLogo')->setName('');
	$this->delete('/{client_id:[0-9]+}', 'clients_controller:delete')->setName('clients_delete')->add('api_log');
})->add('auth');
