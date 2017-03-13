<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use APILIB\Models\BaseModel;

class Client extends BaseModel
{
  use SoftDeletes;

}
