<?php
$app->group('/items', function () {
	$this->post('', 'items_controller:create')->setName('items_create')->add('api_log');
	$this->put('/{item_id:[0-9]+}', 'items_controller:update')->setName('items_update')->add('api_log');
	$this->get('', 'items_controller:get')->setName('items_get');
	$this->get('/{item_id:[0-9]+}', 'items_controller:find')->setName('items_find');
	$this->delete('/{item_id:[0-9]+}', 'items_controller:delete')->setName('items_delete')->add('api_log');
})->add('auth');
