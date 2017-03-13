<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use APILIB\Models\BaseModel;
use \App\Scopes\CurrentClient;

class APILog extends BaseModel
{

  use SoftDeletes;
  use CurrentClient;

  protected $table = 'api_log';

  public function client()
  {
    return $this->belongsTo('\App\Models\Client');
  }

  public function user()
  {
    return $this->belongsTo('\App\Models\User');
  }

}
