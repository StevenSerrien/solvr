<?php

namespace App\Models\Color;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
  protected $guarded = [
    'id',
  ];

  public function excercises() {
    return $this->hasMany('App\Models\Excercise\Excercise');
  }

}
