<?php

namespace App\Models\Subcategory;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
  protected $guarded = [
    'id',
  ];

    return $this->hasOne('App\Models\Category\Category');
}
