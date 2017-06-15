<?php

namespace App\Http\Controllers\Colorscheme;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Color\Color;
use App\Models\Colorscheme\Colorscheme;
use Illuminate\Support\Facades\Auth;

class ColorschemeController extends Controller
{
    public function getAllColorschemes() {
      $colorschemes = Colorscheme::all();
      return $colorschemes;
    }

    public function getCurrentUserColorscheme() {

      $loggedUser = Auth::guard('web')->user()->with('colorscheme')->first();

      return $loggedUser;
      $colorschemes = Colorscheme::all();
      return $colorschemes;
    }

    public function changeColorscheme(Request $request) {

      return $request->all();

      // $solorscheme = Colorscheme::where('hex', 'like', '%' . $request . '%')->first();
      // return $solorscheme;
    }
}
