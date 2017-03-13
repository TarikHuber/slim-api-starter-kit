<?php

namespace App\Localisation;


class en {

  public static function getMessages(){
    return [
      'hello_world'=>'Hello World!',
      'signup_failed_message'=>'SignUp Failed!',
      'email_not_registered_message'=>'Email not registered',
      'user_not_activated_message'=>'User not activated',
      'invalid_password_message'=>'Invalid Password!',
      'validation_failed_message'=>'Validation failed!',
      'creation_failed_message'=>'Creation failed!',
      'updating_failed_message'=>'Updating failed!',
      'deletion_failed_message'=>'Deletion failed!',
      'unknown_error'=>'Unknown error occured!',
      'new_user_registered'=>'New user registered: {{name}}',
      'user_name'=>'Name: {{name}}',
      'user_email'=>'E-Mail: {{email}}',
      'authorisation_failed_message'=>'You have no access to this section!'
    ];
  }

}
