<?php
$app->group('/users', function () {
  $this->get('', 'users_controller:get')->setName('users_get');
  $this->get('/{user_id:[0-9]+}', 'users_controller:find')->setName('users_find');
  $this->put('/{user_id:[0-9]+}', 'users_controller:update')->setName('users_update')->add('api_log');
  $this->put('/{user_id:[0-9]+}/change_password', 'users_controller:changePassword')->setName('users_change_password')->add('api_log');
  $this->delete('/{user_id:[0-9]+}', 'users_controller:delete')->setName('users_delete')->add('api_log');
})->add('auth');
