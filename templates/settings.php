<?php
return [
  'settings' => [
    'displayErrorDetails' => false, // set to false in production
    'web_url' => 'http://app_url',

    // Database settings
    'db' => [
      'username' => 'db_username',
      'password' => 'db_password',
      'host' => 'db_host',
      'port' => 'db_port',
      'socket' => 'db_socket',
      'name' => 'db_name',
      //Eloquent
      'driver' => 'mysql',
      'lifetime' => 120,
      'database' => 'db_name',
      'charset'   => 'utf8',
      'collation' => 'utf8_unicode_ci',
      'prefix'    => '',
    ],

    // PHPMailer settingss
    'phpmailer' => [
      'CharSet' => 'UTF-8',
			'Host' => 'smtp.gmail.com',
			'SMTPAuth' => true,
			'Username' => 'some_email@gmail.com',
			'Password' => 'password',
			'SMTPSecure' => 'tls',
			'Port' => 587,
    ],

    'auth_header'=>[
      'api_key_name'=>'Authorization',
      'client_id'=>'Client',
    ],


  ],
];
