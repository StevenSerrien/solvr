<?php

namespace App\Http\Controllers\Contact;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Practice\Practice;
use App\Models\Practitioner\Practitioner;


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

      return $id;
      return 'yolo';
    }
}
