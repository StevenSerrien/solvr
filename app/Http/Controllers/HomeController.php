<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Practice\Practice;
use App\Models\Practitioner\Practitioner;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('welcome');
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
