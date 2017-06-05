<?php

namespace App\Models\Practitioner;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Practitioner extends Authenticatable
{
    use Notifiable;

    protected $guard = 'practitioner';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [
      'id',
      'isConfirmed',
      'confirmation_code',
      'isAdmin',
      'practice_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function practice() {
      return $this->belongsTo('App\Models\Practice\Practice');
    }
}
