@extends('layouts.app')


@section('content')
  <div ng-controller='ContactSignupCtrl as contact'>


  <div class="full-screen-container full-screen-container--w-centered-content"  ng-class='contact.state.currentTemplate.stateClass'>

    <div class="row">







      <div ng-form="parentForm" class="form-block form-block--contact-signup small-centered large-12 columns">
        <div class="row">
          <div class="large-12 columns" vertilize-container>
            <!-- Steps for a complete contact signup form. SEE: views/states/contact/*.html -->
            <div ng-include='contact.state.currentTemplate.url' ng-class="contact.state.animationClass" vertilize>

            </div>
          </div>
        </div>
        {{-- <div class="row">
          <div class="large-12 columns">
            ##contact.state.response##
          </div>
        </div> --}}

        <div class="row small-collapse">
          <div class="large-12 columns form-block__progressbar-container small-centered">
            <div class="form-block__progress-bar" ng-class="{'step-1': contact.state.currentTemplate.index === 1, 'step-2': contact.state.currentTemplate.index === 2, 'step-3': contact.state.currentTemplate.index === 3}">
              <div class="form-block__progress-circle form-block__progress-circle--1" ng-class="{'is-done': contact.state.currentTemplate.index > 0, 'is-active': contact.state.currentTemplate.index === 0}">  </div>
              <div class="form-block__progress-circle form-block__progress-circle--2" ng-class="{'is-done': contact.state.currentTemplate.index > 1, 'is-active': contact.state.currentTemplate.index === 1}"> </div>
              <div class="form-block__progress-circle form-block__progress-circle--3" ng-class="{'is-done': contact.state.currentTemplate.index > 2, 'is-active': contact.state.currentTemplate.index === 2}"> </div>
              <div class="form-block__progress-circle form-block__progress-circle--4" ng-class="{'is-done': contact.state.currentTemplate.index === 3}"> </div>
            </div>
            <button type="button" class='form-block__button form-block__progress-back' ng-hide='contact.state.currentTemplate.index === 3' ng-show='contact.state.currentTemplate.index !== 0' data-ng-click='contact.events.changeTemplate(contact.state.currentTemplate.index - 1)' name="button">back</button>

            <button type="button" ng-if='contact.state.currentTemplate.index === 0' class='form-block__button form-block__progress-next' ng-disabled="parentForm.therapistPersonalSignupForm.$invalid || contact.state.loading" data-ng-click='contact.events.updateUserData(contact.state.currentTemplate.index)' name="button">volgende</button>
            <button type="button" ng-if='contact.state.currentTemplate.index === 1' class='form-block__button form-block__progress-next' ng-disabled='parentForm.therapistExistingPracticeSignupForm.$invalid' data-ng-click='contact.events.updateUserData(contact.state.currentTemplate.index)' name="button">volgende</button>

            <button type="button" ng-if="contact.state.currentTemplate.index === 2 && contact.user.practiceStatus == 'new'" class='form-block__button form-block__progress-next' ng-disabled='parentForm.therapistPracticeInfoNewSignupForm.$invalid || contact.state.registerloading == true' data-ng-click='contact.events.updateUserData(contact.state.currentTemplate.index)' name="button">registreren</button>
            <button type="button" ng-if="contact.state.currentTemplate.index === 2 && contact.user.practiceStatus == 'existing'" class='form-block__button form-block__progress-next' ng-disabled='parentForm.therapistPracticeInfoExistingSignupForm.$invalid || contact.state.registerloading == true' data-ng-click='contact.events.updateUserData(contact.state.currentTemplate.index)' name="button">registreer</button>

          </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>



@endsection
@section('scripts')
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA2TtmcARObbsZdvdfKkXlYuGVvmnDadfE&libraries=places"
  async defer></script>
@endsection
