<?php

$app->group('/grants', function () {
	$this->get('', 'grants_controller:getAll')->setName('grants_get_all');
})->add('auth');
