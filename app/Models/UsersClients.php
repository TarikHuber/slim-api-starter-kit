<?php

namespace App\Models;
use APILIB\Models\BaseModel;
use \App\Helpers\ModelHelper;

class UsersClients extends BaseModel
{
  protected $table = 'client_user';

  public function user()
  {
    return $this->hasOne('\App\Models\User','id','user_id');
  }

  public function client()
  {
    return $this->hasOne('\App\Models\Client','id','client_id');
  }

}
