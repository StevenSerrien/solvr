<?php

namespace App\Models\Colorscheme;

use Illuminate\Database\Eloquent\Model;

class Colorscheme extends Model
{
  public function users() {
    return $this->hasMany('App\Models\User');
  }
}
