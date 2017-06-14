<?php

namespace App\Http\Controllers\Exercise;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category\Category;
use App\Models\Age\Age;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ExerciseController extends Controller
{
    public function index() {
      $categories = Category::all();
      return view('practitioner.exercises.main')->with('categories', $categories);;
    }

    public function showMake($category_id, $slug=null) {
      $agesRanges = Age::all();

      try {
        $category = Category::findorFail($category_id);
      } catch (Exception $e) {
        return redirect('/');
      }

      if ($slug !== str_slug($category->name)) {
        return redirect(action('Exercise\ExerciseController@showMake', ['category_id' => $category->id, 'slug' => str_slug($category->name)]), 301);
      }
      return view('practitioner.exercises.make')->with('category', $category)->with('ageRanges', $agesRanges);
    }
}
