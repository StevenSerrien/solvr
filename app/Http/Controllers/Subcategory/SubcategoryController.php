<?php

namespace App\Http\Controllers\Subcategory;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category\Category;
use App\Models\Subcategory\Subcategory;
class SubcategoryController extends Controller
{
    public function getAllSubcategoriesForCategory(Request $request) {

      // Select all subcategories for given category
      $category = Category::where('id', $request->id)->with('subcategories')->first();
      $subcategories = $category['subcategories'];
      return $subcategories;

    }
}
