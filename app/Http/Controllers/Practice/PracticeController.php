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

    public function updateSpecialities(Request $request) {
      $specialities =  $request->all();
      $practice =   Auth::guard('practitioner')->user()->practice;

      // return $practice->specialities()->get();
      $practice->specialities()->detach();
      foreach ($specialities as $speciality) {
          if(!$practice->specialities->contains($speciality))
          {
            $practice->specialities()->attach($speciality);
          }
      }

        return $practice->specialities()->get();
      }

    public function getSpecialities(Request $request) {
      $practice =  $request;

      $practice = Practice::where('id', $practice->id)->with('specialities')->first();

      return $practice->specialities;
    }

}
