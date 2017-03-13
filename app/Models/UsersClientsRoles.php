<?php

namespace App\Models;
use APILIB\Models\BaseModel;
use \App\Helpers\ModelHelper;

class UsersCLientsRoles extends BaseModel
{
  protected $table = 'users_clients_roles';

  public function client()
  {
    return $this->hasOne('\App\Models\Client','id','client_id');
  }

  public function user()
  {
    return $this->hasOne('\App\Models\User','id','user_id');
  }

  public function role()
  {
    return $this->hasOne('\App\Models\Role','id','role_id');
  }

}
