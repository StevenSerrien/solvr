<?php

namespace App\Models\Question;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
  protected $guarded = [
    'id',
  ];

  public function exercise() {
    return $this->belongsTo('App\Models\Exercise\Exercise');
  }

  public function answers() {
    return $this->hasMany('App\Models\Answer\Answer');
  }
}
