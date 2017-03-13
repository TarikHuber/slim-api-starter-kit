<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use APILIB\Models\BaseModel;
use \App\Scopes\CurrentClient;

class Item extends BaseModel
{

  use SoftDeletes;
  use CurrentClient;

}
