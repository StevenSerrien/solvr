<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;

class PractitionerLoginController extends Controller
{
  public function __construct()
  {
    $this->middleware('guest:practitioner');
  }

  use AuthenticatesUsers;

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


  public function showLoginForm() {
    return view('auth.practitioner.login');
  }

  public function login(Request $request) {
    // Validate the form database
    $this->validate($request, [
      'email' => 'required|email',
      'password' => 'required',
    ]);
    // Attempt to log the user in
    $credentials = $request->only('email', 'password');

    if (  Auth::guard('practitioner')->validate($credentials) ) {


      // Check if this practitioner is confirmed yet!
      $practitioner = Auth::guard('practitioner')->getLastAttempted();

      if ($practitioner->isConfirmed == 0) {
        // Practitioner not confirmed
        return redirect()->back()->withInput($request->only('email'))->withErrors([
          'isConfirmed' => 'Dit account moet nog bevestigd worden door ons.',
        ]);
      }
      // If successful, then redirect to their intended location
      Auth::guard('practitioner')->login($practitioner);
      return redirect()->intended(route('practitioner.dashboard'));

    }

      // If unsuccessfull, then reidrect back to the login with form data
      return redirect()->back()->withInput($request->only('email'))->withErrors([
        'email' => 'Foutief emailadres of wachtwoord.',
        'password' => 'Foutief emailadres of wachtwoord.',
        'isConfirmed' => 'Dit account moet nog bevestigd worden door ons.',
      ]);


  }
}
