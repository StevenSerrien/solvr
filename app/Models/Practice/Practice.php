<?php

namespace App\Models\Practice;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Practice extends Model
{
  use Notifiable;


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

  public function specialities() {
    return $this->belongsToMany('App\Models\Speciality\Speciality');
  }
}
