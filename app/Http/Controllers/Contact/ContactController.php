<?php

namespace App\Http\Controllers\Contact;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Practice\Practice;
use App\Models\Practitioner\Practitioner;
use App\Notifications\newContactRequest;


class ContactController extends Controller
{
    public function index ($id, $slug=null) {
      try {
        $practiceSelected = Practice::with('specialities')->findorFail($id);
      } catch (Exception $e) {
        return redirect('/');
      }

      if ($slug !== str_slug($practiceSelected->name)) {
        return redirect(action('Contact\ContactController@index', ['id' => $practiceSelected->id, 'slug' => str_slug($practiceSelected->name)]), 301);
      }
      return view('pages.contact')->with('practiceSelected', $practiceSelected);

    }

    public function contactPractice(Request $request) {
      $practice = $request->get('practice');
      $requester = $request->get('user');



      $practice = Practice::where('id', $practice['id'])->first();

      $practitioners = $practice['practitioners'];

      // Only send notification to confirmed practitioners
      $practitioners = $practitioners->where('isConfirmed', 1);



      // Send notifications to practitioners on new contact request
      foreach ($practitioners as $practitioner) {
        $practitioner->notify(new newContactRequest($practitioner, $practice, $requester));
      }

      $returnData = array(
        'status' => 'success',
        'message' => 'Uw bericht werd goed ontvangen. Wij nemen zo snel mogelijk contact met u op.',
      );

      return response()->json($returnData, 200);
      // return $practitioners;
      // return $requester;
      // return $request->all();
    }
}
