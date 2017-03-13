<?php

namespace App\Localisation;


class de {

  public static function getMessages(){
    return [
      'hello_world'=>'Hallo Welt!',
      'signup_failed_message'=>'Registrierung fehlgeschlagen!',
      'email_not_registered_message'=>'Email nicht registriert',
      'user_not_activated_message'=>'Benutzer nicht aktiviert',
      'invalid_password_message'=>'Falsches Passwort!',
      'validation_failed_message'=>'Validierung fehlgeschlagen!',
      'creation_failed_message'=>'Erstellung fehlgeschlagen!',
      'updating_failed_message'=>'Änderung fehlgeschlagen!',
      'deletion_failed_message'=>'Löschen fehlgeschlagen!',
      'unknown_error'=>'Unerwarteter Fehler aufgetreten!',
      'new_user_registered'=>'Neuer Benutzer registriert: {{name}}',
      'user_name'=>'Name: {{name}}',
      'user_email'=>'E-Mail: {{email}}',
      'authorisation_failed_message'=>'Kein Zugang zu diesem Bereich!'
    ];
  }

}
