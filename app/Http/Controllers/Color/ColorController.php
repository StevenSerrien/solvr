<?php

namespace App\Http\Controllers\Color;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Color\Color;

class ColorController extends Controller
{
    public function getAllColors() {
      $colors = Color::all();
      return $colors;
    }
}
