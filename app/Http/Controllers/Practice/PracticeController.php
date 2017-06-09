<?php

namespace App\Http\Controllers\Practice;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Practice\Practice;
use App\Models\Practitioner\Practitioner;
use Illuminate\Support\Facades\Auth;

class PracticeController extends Controller
{
    public function getAllExistingPractices() {

      // Todo - ONLY Confirmed practices
      $practices =  Practice::all();
      return $practices;
    }

    public function getPracticeById(Request $request) {

      if ($request) {
        $index = $request->index;

        $practice = Practice::where('id', $index)->get();

        if ($practice) {
          return $practice;
        }
      }
    }

    public function getAllPractitionersForLoggedUser() {
      $loggedPractitioner = Auth::guard('practitioner')->user();
      $practiceId =  $loggedPractitioner->practice->id;
      return Practice::where('id', $practiceId)->with('practitioners')->get();
    }
}
