<?php

$app->group('/api_logs', function () {
	$this->get('', 'api_log_controller:get')->setName('api_logs_get');
	$this->get('/{api_log_id:[0-9]+}', 'api_log_controller:find')->setName('api_logs_find');
})->add('auth');
