<?php

namespace App\Models\Subcategory;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
  protected $guarded = [
    'id',
  ];

  public function subcategories() {
    return $this->belongsTo('App\Models\Category\Category');
  }

}
