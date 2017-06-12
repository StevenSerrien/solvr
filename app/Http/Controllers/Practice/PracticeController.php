<?php

namespace App\Http\Controllers\Practice;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Practice\Practice;
use App\Models\Practitioner\Practitioner;
use Illuminate\Support\Facades\Auth;

// For distance calculation ;)
use Location\Coordinate;
use Location\Distance\Vincenty;

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

    public function getPracticesBySpecialities(Request $request) {
      // Package to calulcate distance between two points
      $calculator = new Vincenty();

      // Get data from request
      $specialitiesIDArray =  $request->get('selectedSpecialities');
      $practices = Practice::with('specialities');


      $address = $request->address;

      if ($specialitiesIDArray) {
        foreach ($specialitiesIDArray as $specialityID) {
          $practices = $practices->whereHas('specialities', function($query) use ($specialityID) {
            $query = $query->where('id', $specialityID);
          });
        }
        $practices = $practices->get();
      }
      else {
        $practices = $practices->get();
      }

      if ($address) {
        // Add distance field to $practices
        $addressCoordinates =  new Coordinate($address['lat'], $address['lng']);
        // Add distance to practices based upon given address and practice coordinates
        foreach ($practices as $practice) {
          $practiceCoordinates = new Coordinate($practice['lat'], $practice['lng']);
          $practice->distance = $calculator->getDistance($addressCoordinates, $practiceCoordinates);
        }
      }
      return $practices;

    }

}
