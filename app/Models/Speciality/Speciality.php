<?php

namespace App\Models\Speciality;

use Illuminate\Database\Eloquent\Model;

class Speciality extends Model
{



  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $guarded = [
    'id',
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */

  public function practices() {
    return $this->belongsToMany('App\Models\Practice\Practice')->withTimestamps();
  }

}
