<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Colorscheme\Colorscheme;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{


  public function __construct()
    {
        $this->middleware('auth');
    }


    public function index() {
      $loggedUser = Auth::guard('web')->user();

      return view('user.dashboard');
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
