<?php

namespace App\Http\Controllers\PractitionerAuth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Practice\Practice;
use App\Models\Practitioner\Practitioner;
// use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    // use RegistersUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function showRegistrationForm()
    {
      return view('auth.practitioner.register');
    }


    public function checkIfPractitionerExists(Request $request)
    {
      $postEmail = $request->email;
      $emailExists = Practitioner::where('email',$postEmail)->first();

      // Check if email is already registered for confirmed account
      if ($emailExists) {
        $status = 'error';
        if ($emailExists->isConfirmed == 1) {
          $message = 'Dit emailadres is reeds gebruikt.';

        }
        else {
          $message = 'Dit emailadres is reeds geregistreerd, maar moet nog bevestigd worden door ons.';
        }
        $code = 500;
        $error = 'email';
      }
      else {
          $status = 'success';
          $message = 'Emailadres is nog beschikbaar.';
          $code = 200;
          $error = 'none';
      }

      $returnData = array(
        'status' => $status,
        'message' => $message,
        'error' => $error
      );

      return response()->json($returnData, $code);
    }

    public function test(Request $request) {


      $postEmail = $request->email;
      $emailExists = Practitioner::where('email',$postEmail)->first();

      // Check if email is already registered for confirmed account
      if ($emailExists) {
        $status = 'error';
        if ($emailExists->isConfirmed == 1) {
          $message = 'Dit emailadres is reeds gebruikt.';

        }
        else {
          $message = 'Dit emailadres is reeds geregistreerd, maar moet nog bevestigd worden door ons.';
        }
        $code = 500;
        $error = 'email';
      }
      else {
          $status = 'success';
          $message = 'Emailadres is nog beschikbaar.';
          $code = 200;
          $error = 'none';
      }

      $returnData = array(
        'status' => $status,
        'message' => $message,
        'error' => $error
      );

      return response()->json($returnData, $code);

    }
}
