@extends('layouts.app')

@section('content')
<div ng-controller='practiceContactController as pcontact'>


<div class="p-container p-container--bg-contact">
  {{-- <div class="p-item p-item--landing"> --}}

  <div class="row m-t-60" data-equalizer data-equalize-on="medium">
    <div class="large-5 columns p-rel" data-equalizer-watch>
      <div class="blockz blockz-animated blockz-animated--1 slide-in-from-bottom">
        <h2 class='t--semi-bold text-center'>Praktijk <span class='highlight highlight--color-1'>{{ $practiceSelected->name }}</span></h2>
        <h3 class='t--regular t--lightest text-center m-b-40'>.</h3>
        <div class="blockz__inner blockz__inner--summary">
          <span class='header'>Waar vindt u hen?</span>
          <span class='text'>{{ $practiceSelected->streetname }} {{ $practiceSelected->housenumber }}</span>
          <span class='text'>{{ $practiceSelected->locality }} {{ $practiceSelected->postal_code }}</span>
        </div>
        <div class="blockz__inner blockz__inner--summary m-t-40">
          <span class='header'>Hebben ze specialisaties?</span>
          @if (is_null($practiceSelected->specialities))
            <span class='text'>Geen specifieke specialisaties</span>
          @else
            <span class='text'>
            @foreach($practiceSelected->specialities as $speciality)

                @if (count($practiceSelected->specialities) >= 1)
                  {{ $speciality->name }}
                  @if (($speciality == end($practiceSelected->specialities)))
                    en
                  @else
                    ,
                  @endif
                @endif
            @endforeach
            </span>
          @endif

        </div>
        <div class="blockz__inner blockz__inner--summary m-t-40">
          <span class='header'>Andere informatie</span>
            <span class='text'>Liever een telefonisch gesprek?</span>
            <span class='text'>{{ $practiceSelected->telephone }}</span>

        </div>
      </div>
    </div>

    <!-- contactform -->
    <div class="large-7 columns p-rel" data-equalizer-watch>
      <div class="blockz blockz-animated blockz-animated--2 slide-in-from-bottom">
        <h2 class='t--semi-bold text-center'>Vul het contactformulier <span class='highlight highlight--color-1'>in</span></h2>
        <h3 class='t--regular t--lightest text-center m-b-40'>Probeer zo volledig mogelijk te zijn</h3>
        <div class="row">
          <form name='practiceContactForm'>


          <div class="medium-6 columns">
              <input class='input--stnrd' type="text" ng-model='pcontact.state.datatosend.user.firstname' placeholder="Jouw voornaam" autocomplete="off" required >
          </div>
          <div class="medium-6 columns">
              <input class='input--stnrd' type="text" ng-model='pcontact.state.datatosend.user.lastname' placeholder="Jouw achternaam" autocomplete="off" required>
          </div>
          <div class="medium-6 columns">
              <input class='input--stnrd' type="text" ng-model='pcontact.state.datatosend.user.telephone' placeholder="Telefoon (niet verplicht)" autocomplete="off" required>
          </div>
          <div class="medium-6 columns">
              <input class='input--stnrd' type="email" ng-model='pcontact.state.datatosend.user.email' placeholder="E-mailadres" autocomplete="off" required>
          </div>
          <div class="large-12 columns">
              <textarea class='input--stnrd' ng-model='pcontact.state.datatosend.user.message' style="overflow:auto;resize:none" name="name" rows="6" placeholder='Uw bericht aan deze praktijk' cols="80"></textarea>
          </div>
          <div class="large-12 columns">
            <button type="button" class='btn btn--frm btn--frm--color-2 btn--block m-t-20'  ng-click='pcontact.handlers.sendContactForm({{ $practiceSelected }})' name="button">verzenden</button>
          </div>
          </form>
        </div>

      </div>
    </div>
  </div>


</div>
</div>

@endsection
