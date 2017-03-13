<?php

//Authentication
$app->group('/auth', function () {
	$this->post('/signup', 'authentication_controller:signUp');
	$this->post('/signin', 'authentication_controller:signIn');
});
