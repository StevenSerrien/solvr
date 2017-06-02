<?php

namespace App\Http\Controllers\Page;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
  public function viewAboutPage() {
    return view('pages.about');
  }
  public function viewTherapistsPage() {
    return view('pages.therapist');
  }

  public function viewContactPage() {
    return view('pages.contact');
  }
}
