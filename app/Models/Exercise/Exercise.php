<?php

namespace App\Models\Exercise;

use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
  protected $guarded = [
    'id',
  ];

  public function practitioner() {
    return $this->belongsTo('App\Models\Practitioner\Practitioner');
  }

  public function age() {
    return $this->belongsTo('App\Models\Age\Age');
  }

  public function color() {
    return $this->belongsTo('App\Models\Color\Color');
  }

  public function subcategory() {
    return $this->belongsTo('App\Models\Subcategory\Subcategory');
  }

  public function questions() {
    return $this->hasMany('App\Models\Question\Question');
  }

  public function practice() {
    return $this->belongsTo('App\Models\Practice\Practice');
  }
}
