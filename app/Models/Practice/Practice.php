<?php

namespace App\Models\Practice;

use Illuminate\Database\Eloquent\Model;

class Practice extends Model
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
  protected $hidden = [
      'password', 'remember_token',
  ];

  public function practitioners() {
    return $this->hasMany('App\Models\Practitioner\Practitioner');
  }
}