<?php
$app->group('/me', function () {
	$this->get('', 'me_controller:get')->setName('me');
	$this->put('', 'me_controller:update')->setName('me')->add('api_log');
	$this->put('/change_password', 'me_controller:changePassword')->setName('me');
})->add('auth');

$app->get('/my_clients', 'me_controller:clients')->setName('')->add('auth');
