<?php

namespace App\Models\Category;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
  protected $guarded = [
    'id',
  ];


  public function subcategory() {
    return $this->hasOne('App\Models\Subcategory\Subcategory');
  }
}
