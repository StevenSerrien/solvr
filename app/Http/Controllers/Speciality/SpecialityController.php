<?php

namespace App\Http\Controllers\Speciality;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Speciality\Speciality;

class SpecialityController extends Controller
{
    public function getAllSpecialities() {
      // Todo - ONLY Confirmed practices
      $specialities =  Speciality::all();
      return $specialities;
    }
}
