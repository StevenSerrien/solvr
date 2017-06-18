<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Practice\Practice;
use App\Models\Practitioner\Practitioner;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Validator;
use App\Notifications\newPractitionerRequest;
use App\Notifications\newPractitionerAccountRequestReceived;

class PractitionerRegisterController extends Controller
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
          $message = 'Oopsie! Dit emailadres is reeds gebruikt.';

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

    public function checkIfPracticeExists(Request $request)
    {
      // return $request->all();
      $practiceName = $request->name;
      $practiceStreet = $request->route;
      $practiceStreetNumber = $request->street_number;

      $practiceNameExists = Practice::where('name', $practiceName)->first();
      $practiceLocationExists = Practice::where('streetname', $practiceStreet)->where('housenumber', 'LIKE', '%' . $practiceStreetNumber . '%')->first();


      if ($practiceNameExists || $practiceLocationExists) {
        // Name already in database
        if ($practiceNameExists) {
          $status = 'error';
          $error = 'practicename';
          $message = 'Woops! Er is al een praktijk met die naam bij ons.';
        }
        // Practice already registered on that address
        if ($practiceLocationExists) {
          $status = 'error';
          $error = 'practicelocation';
          $message = 'Er is al een praktijk geregistreerd op dat adres.';
        }
        $code = 500;
      }
      else {
        $status = 'success';
        $error = 'none';
        $message = 'Adres en naam nog beschikbaar.';
        $code = 200;
      }

      $returnData = array(
        'status' => $status,
        'message' => $message,
        'error' => $error
      );

      return response()->json($returnData, $code);
    }

    public function register(Request $request) {


      $existingPractice = $request->get('existingPractice');
      $practice = $request->get('practice');
      $practitioner = $request->get('user');




      // If user has selected an existing practice to link with
      if ($existingPractice) {
        $practitionerValidator = Validator::make($practitioner, [
          'firstname' => 'required',
          'lastname' => 'required',
          'email' => 'required|email',
          'rizivnumber' => 'required',
          'password' => 'required',
        ]);

        if ($practitionerValidator->fails()) {
          $returnData = array(
            'status' => 'error',
            'message' => 'Validation errors!',
            'error' => $practiceValidator->errors(),
          );
          return response()->json($returnData, 500);
        }


        //  Testing

        // return $practitioner;


        // Testing

        $newPractitioner = new Practitioner();

        $newPractitioner->firstname = $practitioner['firstname'];
        $newPractitioner->lastname = $practitioner['lastname'];
        $newPractitioner->rizivnumber = $practitioner['rizivnumber'];
        $newPractitioner->email = $practitioner['email'];
        $newPractitioner->password = bcrypt($practitioner['password']);
        $newPractitioner->practice_id = $existingPractice['id'];

        $newPractitioner->confirmation_code = str_random(30);
        $newPractitioner->IsConfirmed = 0;
        $newPractitioner->IsAdmin = 0;

        $practitionerSaved = $newPractitioner->save();




        $notifiablyRequester = Practitioner::where('id', $newPractitioner->id)->first();

        if ($practitionerSaved) {
          $returnData = array(
            'status' => 'success',
            'message' => 'Logopedist aangemaakt en gelinkt aan bestaande praktijk!',
          );


          // Notify adminPractitioner
          $requester = $practitioner;
          $notifiableAdminPractitioner = Practitioner::where('practice_id', $existingPractice['id'])->where('isAdmin', 1)->first();

          $notifiablyRequester->notify(new newPractitionerAccountRequestReceived($notifiablyRequester, $existingPractice));
          $notifiableAdminPractitioner->notify(new newPractitionerRequest($notifiableAdminPractitioner, $requester));
          return response()->json($returnData, 200);
        }
      }
      // If user has selected he/she wants to register new practice
      else {
        $practiceValidator = Validator::make($practice, [
          'name' => 'required',
          'lat' => 'required',
          'lng' => 'required',
          'route' => 'required',
          'street_number' => 'required',
          'locality' => 'required',
          'postal_code' => 'required',
          'telephone' => 'required',
        ]);

        $practitionerValidator = Validator::make($practitioner, [
          'firstname' => 'required',
          'lastname' => 'required',
          'email' => 'required|email',
          'rizivnumber' => 'required',
          'password' => 'required',
        ]);

        // BACKEND ERRORS ON REQUESTED DATA - Validators fails
        if ($practitionerValidator->fails() || $practiceValidator->fails()) {
          if ($practiceValidator->fails()) {
            $returnData = array(
              'status' => 'error',
              'message' => 'Validation errors!',
              'error' => $practiceValidator->errors(),
            );
            return response()->json($returnData, 500);
          }
          if ($practitionerValidator->fails()) {
            $returnData = array(
              'status' => 'error',
              'message' => 'Validation errors!',
              'error' => $practiceValidator->errors(),
            );
            return response()->json($returnData, 500);
          }
        }

        // BACKEND SUCCESS ON REQUESTED DATA - Validators passed
        else {

          // First making new practice
          $newPractice = new Practice();

          $newPractice->name = $practice['name'];
          $newPractice->streetname = $practice['route'];
          $newPractice->housenumber = $practice['street_number'];
          $newPractice->locality = $practice['locality'];
          $newPractice->postal_code = $practice['postal_code'];
          $newPractice->telephone = $practice['telephone'];
          $newPractice->lat = $practice['lat'];
          $newPractice->lng = $practice['lng'];

          $practiceSaved = $newPractice->save();
          // return $newPractice;

          $newPractitioner = new Practitioner();

          $newPractitioner->firstname = $practitioner['firstname'];
          $newPractitioner->lastname = $practitioner['lastname'];
          $newPractitioner->rizivnumber = $practitioner['rizivnumber'];
          $newPractitioner->email = $practitioner['email'];
          $newPractitioner->password = bcrypt($practitioner['password']);
          $newPractitioner->practice_id = $newPractice->id;

          $newPractitioner->confirmation_code = str_random(30);
          $newPractitioner->IsConfirmed = 0;
          $newPractitioner->IsAdmin = 1;

          $practitionerSaved = $newPractitioner->save();

          if ($practitionerSaved && $practiceSaved) {
            $returnData = array(
              'status' => 'success',
              'message' => 'Logopedist en praktijk aangemaakt!',
            );
            return response()->json($returnData, 200);
          }

        }
      }
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
