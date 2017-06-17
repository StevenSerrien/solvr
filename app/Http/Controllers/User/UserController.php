<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Colorscheme\Colorscheme;
use App\Models\Category\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserController extends Controller
{


  public function __construct()
    {
        $this->middleware('auth');
    }


    public function index() {
      $loggedUser = Auth::guard('web')->user();
      $categories = Category::all();

      return view('user.dashboard')->with('categories', $categories);
    }

    public function showExerciseCodePage($id, $slug=null) {

      try {
        $category = Category::with('subcategories')->findorFail($id);
      } catch (Exception $e) {
        return redirect('/');
      }

      if ($slug !== str_slug($category->name)) {
        return redirect(action('User\UserController@showExerciseCodePage', ['id' => $category->id, 'slug' => str_slug($category->name)]), 301);
      }
      return view('user.exercises.exercise-code');
    }

    public function showAchievementsPage() {
      return view('user.achievements');
    }

    public function showConnectedPage() {
      return view('user.connected');
    }

    public function changeColorscheme(Request $request) {

      $colorhexcode = $request[0];
      // return $request[0];

      $solorscheme = Colorscheme::where('hex', 'like', '%' . $colorhexcode . '%')->first();
      // return $solorscheme->id;

      $loggedUser = Auth::guard('web')->user();

      $loggedUser->colorscheme_id = $solorscheme->id;
      $loggedUser->save();
      return $loggedUser;


      // return $solorscheme;
    }

    public function getCurrentUserColorscheme() {

      $loggedUser = Auth::guard('web')->user()->with('colorscheme')->first();

      return $loggedUser;
      $colorschemes = Colorscheme::all();
      return $colorschemes;
    }


}
