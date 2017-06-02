@extends('layouts.app')


@section('content')

  <div class="s-container s-container--no-p">
  <div class="section section--type-2 p-t-100 p-b-100" ng-controller='ContactSignupCtrl as contact'>

  <div ng-include='contact.state.currentTemplate.url' class="">

  </div>
  {{-- <form class="" ng-controller='ContactSignupCtrl as contact'>
  <div class="row">
    <div class="large-12 columns">
      <h2 class='t--semi-bold text-center'>Neem contact op</h2>
      <h3 class='t--regular t--lightest m-b-60 m-t-60'>Uw persoonlijke gegevens</h3>
    </div>
  </div>
  <div class="row">
    <div class="medium-6 columns">
      <label>Voornaam
        <input type="text" ng-model='contact.user.firstname' placeholder="Voornaam">
      </label>
    </div>
    <div class="medium-6 columns">
      <label>Achternaam
        <input type="text" ng-model='contact.user.lastname' placeholder="Achternaam">
      </label>
    </div>
    <div class="medium-6 columns">
      <label>Heeft u een RISIV nummer?
        <select>
          <option value="yes">Husker</option>
          <option value="no">Starbuck</option>
        </select>
      </label>
    </div>
    <div class="medium-6 columns">
      <label>Vul uw RISIV nummer hier in.
        <input type="text" ng-model='contact.user.risivnumber' placeholder="Risivnummer">
      </label>
    </div>
  </div>
  <div class="row">
    <div class="large-12 columns">
      <h3 class='t--regular t--lightest m-b-60 m-t-60'>Praktijkgegevens</h3>
    </div>
  </div>
  <div class="row">
    <div class="large-6 columns">
      <input type="radio" name="practiceChoice" value="" id="cu-newpractice" required><label for="cu-newpractice">Nieuwe praktijk registreren</label>
    </div>
    <div class="large-6 columns">
      <input type="radio" name="practiceChoice" value="Yellow" id="cu-existingpractice"><label for="cu-existingpractice">Mijn praktijk staat al geregistreerd</label>
    </div>
  </div>
  </div>
  </form> --}}
</div>
@endsection
