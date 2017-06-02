@extends('layouts.app')


@section('content')
  <div ng-controller='ContactSignupCtrl as contact'>


  <div class="full-screen-container full-screen-container--w-centered-content" ng-class='contact.state.currentTemplate.stateClass'>

    <div class="row">
      <div class="form-block form-block--contact-signup small-centered large-12 columns">
        <div class="row">
          <div class="large-12 columns" vertilize-container>
            <!-- Steps for a complete contact signup form. SEE: views/states/contact/*.html -->
            <div ng-include='contact.state.currentTemplate.url' ng-class="contact.state.animationClass" vertilize>

            </div>
          </div>



        </div>
      </div>
    </div>
  </div>
  </div>
@endsection
