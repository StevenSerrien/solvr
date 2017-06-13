<?php

namespace App\Http\Controllers\Exercise;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExerciseController extends Controller
{
    public function index() {
      return view('practitioner.exercises.main');
    }
}
