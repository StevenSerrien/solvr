@extends('layouts.app')


@section('content')
  <div ng-controller='ContactSignupCtrl as contact'>


  <div class="full-screen-container full-screen-container--w-centered-content" ng-class='contact.state.currentTemplate.stateClass'>

    <div class="row">
      <div ng-form="parentForm" class="form-block form-block--contact-signup small-centered large-12 columns">
        <div class="row">
          <div class="large-12 columns" vertilize-container>
            <!-- Steps for a complete contact signup form. SEE: views/states/contact/*.html -->
            <div ng-include='contact.state.currentTemplate.url' ng-class="contact.state.animationClass" vertilize>

            </div>
          </div>
        </div>
        <div class="row small-collapse">
          <div class="large-12 columns form-block__progressbar-container small-centered">
            <div class="form-block__progress-bar" ng-class="{'step-1': contact.state.currentTemplate.index === 1}">
              <div class="form-block__progress-circle form-block__progress-circle--1" ng-class="{'is-done': contact.state.currentTemplate.index > 0, 'is-active': contact.state.currentTemplate.index === 0}">
              </div>
            </div>
            <button type="button" class='form-block__button form-block__progress-back' ng-show='contact.state.currentTemplate.index !== 0' data-ng-click='contact.events.changeTemplate(0)' name="button">back</button>
            <button type="button" class='form-block__button form-block__progress-next' ng-disabled='parentForm.therapistPersonalSignupForm.$invalid' data-ng-click='contact.events.updateUserData(contact.state.currentTemplate.index)' name="button">volgende</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
@endsection
