<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use APILIB\Models\BaseModel;

class Role extends BaseModel
{

  use SoftDeletes;

}
