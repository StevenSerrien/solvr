@extends('layouts.u-dashboard')

@section('content')

    <div class="dashboard m-t-60" >
    <div class="f-row row">
      <div class="medium-4 large-2 xlarge-2 columns">
        <div class="dashboard__board dashboard-item-animated dashboard-item-animated--1 slide-in-from-bottom">
          <div class="u-profile-card">


          <div class="u-avatar-wrap">
            <img src="http://api.adorable.io/avatars/285/sofie" alt="">
          </div>
          <div class="dashboard__divider dashboard__divider--full  m-b-20 m-t-20">
          </div>

          <span class='text-center u-d-board-title u-d-t--main u-d-t--color-1 block m-b-40'><span class='u-d-t--secundary t--color-2 u-d-t--bold'>Hoi, </span>Steven</span>
          <div class="u-color-picker">
            <ngjs-color-picker ng-click='user.handlers.changeColorscheme();' selected-color="user.state.selectedColor"  custom-colors='user.state.colorschemes' options='user.state.ngjsColorPicker.options' required></ngjs-color-picker>
          </div>
          </div>


        </div>
      </div>
      <div class="medium-8 large-10 xlarge-10 columns">
        <div class="dashboard__board dashboard-item-animated dashboard-item-animated--2 slide-in-from-bottom">
          <h1 class='text-center u-d-title u-d-t--main'>Wat wil je doen <span class='u-d-t--bold'>vandaag?</span></h1>
          <h2 class='text-center u-d-subtitle u-d-t--main u-d-t--color-2'>Maak je keuze hieronder</h2>
        </div>
      </div>
    </div>
  </div>

@endsection
