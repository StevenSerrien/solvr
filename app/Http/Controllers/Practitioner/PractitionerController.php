<?php

namespace App\Http\Controllers\Practitioner;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PractitionerController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
      $this->middleware('auth:practitioner');
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
      return view('practitioner.dashboard');
  }

  public function test() {
    return Auth::guard('practitioner')->user()->practice->name;
  }
}
