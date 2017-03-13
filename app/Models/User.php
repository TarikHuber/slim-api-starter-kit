<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use APILIB\Models\BaseModel;

class User extends BaseModel
{
  protected $hidden = array('password_hash', 'api_key');
  use SoftDeletes;

  public function clients()
  {
    return $this->belongsToMany('\App\Models\Client');
  }

}
