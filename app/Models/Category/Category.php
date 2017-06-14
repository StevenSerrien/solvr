<?php

namespace App\Models\Category;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
  protected $guarded = [
    'id',
  ];


  public function subcategories() {
    return $this->hasMany('App\Models\Subcategory\Subcategory');
  }

  public function exercises() {
    return $this->hasMany('App\Models\Exercise\Exercise');
  }
}
