<?php

namespace App\Http\Controllers\Practitioner;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Practitioner\Practitioner;
use App\Models\Practice\Practice;

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

  public function getAllPractitioners() {
    return Auth::guard('practitioner')->user()->practice->name;
  }

  public function acceptPractitioner(Request $request) {

    $requesterIsAdmin = Auth::guard('practitioner')->user()->isAdmin;
    if ($requesterIsAdmin == 1) {

      // Practitioner that should be accepted with linked practice
      $practitioner = Practitioner::where('id', $request->id)->with('practice')->first();
      // Confirm practitioner
      $practitioner->isConfirmed = 1;
      $practitioner->save();
      // Send email to practitioner that got accepted that he can now log in.

      // Fill in response data
      $status = 'success';
      $message = $practitioner->firstname . ' is nu verbonden met jouw praktijk.';
      $error = 'none';
      $code = 200;
    }

    $returnData = array(
      'status' => $status,
      'message' => $message,
      'error' => $error
    );

    return response()->json($returnData, $code);


  }
  public function denyPractitioner(Request $request) {

    $requesterIsAdmin = Auth::guard('practitioner')->user()->isAdmin;
    if ($requesterIsAdmin == 1) {

      // Practitioner that should be accepted with linked practice
      $practitioner = Practitioner::where('id', $request->id)->with('practice')->first();
      // Delete practitioner

      $practitioner->delete();
      // Send email to practitioner that got accepted that he can now log in.

      // Fill in response data
      $status = 'success';
      $message = $practitioner->firstname . ' is nu geweigerd voor jouw praktijk.';
      $error = 'none';
      $code = 200;
    }

    $returnData = array(
      'status' => $status,
      'message' => $message,
      'error' => $error
    );

    return response()->json($returnData, $code);


  }
}
