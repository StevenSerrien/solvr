@extends('layouts.dashboard')

@section('content')


  <div class="dashboard dashboard--practice m-t-60" ng-init="practitioner.handlers.initPracticeView()" >
    <div class="row">
      <div class="large-12 columns">
        <div class="dashboard__headtag">
          <div class="badge badge--brand-color-1">
            <i class='icon-star'></i>
          </div>
          <div class="content">
            <h1 class='content__title'>Uw praktijk board</h1>
            <span class='content__subtitle'>Hier vindt je alles over je praktijk en collega's</span>
          </div>
        </div>
      </div>

    </div>
    <div class="row m-t-80">
      <div class="large-6 columns">
        <div class="dashboard__board dashboard-item-animated dashboard-item-animated--1 slide-in-from-bottom">
          <h2 class='d--title'>Uw praktijk ##practitioner.state.practice.name##</h2>
          <h3 class='d--subtitle'>U bent bevestigd door deze praktijk.</h3>
          <div class="dashboard__divider dashboard__divider--small m-b-20">
          </div>
          <div  ng-repeat="lPractitioners in practitioner.state.linkedPractitioners | orderBy:'created_at'" ng-init="$last ? practitioner.handlers.test() : angular.noop()" ng-cloak>
            <div class="dashboard__person m-b-10 clearfix">
              <div class="float-left">
                <div class="avatar">
                 <ng-letter-avatar data="##lPractitioners.firstname##"></ng-letter-avatar>
                </div>
                <div class="content">
                  <span class='content__name d--text d-block'>##lPractitioners.firstname## ##lPractitioners.lastname##</span>
                  <span class='content__riziv d--text d--block'>##lPractitioners.rizivnumber##</span>
                </div>
              </div>

            </div>
          </div>
        </div>

      </div>
      <div class=" large-6 columns">
        <div class="dashboard__board dashboard-item-animated dashboard-item-animated--2 slide-in-from-bottom">
          <h2 class='d--title'>Aanvragen van registraties</h2>
          <h3 class='d--subtitle'>Deze personen willen zich bij uw praktijk voegen.</h3>

        <div class="dashboard__divider dashboard__divider--small m-b-20">
        </div>
        <div  ng-repeat="lPractitioners in practitioner.state.unconfirmedPractitioners | orderBy:'created_at'" ng-init="$last ? practitioner.handlers.test() : angular.noop()" ng-cloak>

          <div class="dashboard__person m-b-10 clearfix">
            <div class="float-left">
            <div class="avatar">
             <ng-letter-avatar data="##lPractitioners.firstname##"></ng-letter-avatar>
            </div>
            <div class="content">
              <span class='content__name d--text d-block'>##lPractitioners.firstname## ##lPractitioners.lastname##</span>
              <span class='content__riziv d--text d--block'>##lPractitioners.rizivnumber##</span>
            </div>
          </div>
          <div class="float-right">
            <div class="buttons">
              <a class='confirm' href ng-click='practitioner.modalHandlers.acceptPractitioner(lPractitioners);'><i class='icon-check'></i></a>
              <a class='deny' href ng-click='practitioner.modalHandlers.denyPractitioner(lPractitioners);'><i class='icon-ban'></i></a>
            </div>

          </div>
        </div>
        </div>
      </div>
      </div>
    </div>
    <div class="row m-t-40">
      <div class=" large-12 columns">
        <div class="dashboard__board dashboard-item-animated dashboard-item-animated--3 slide-in-from-bottom">
          <h2 class='d--title'>Beheer de specialiteiten van jouw praktijk</h2>
          <h3 class='d--subtitle'>Zo vinden clienten jou op specifieke manier.</h3>

        <div class="dashboard__divider dashboard__divider--small m-b-20">
        </div>
        {{-- <so-dropdown-multiple class='cst-dropdown'  ng-change="" ng-model="" placeholder='Voeg specialiteiten toe' dropdown-items="">
          <option value='None'>None</option>
          <option value='dd'>Nonde</option>
          <option value='ye'>None</option>
        </so-dropdown-multiple> --}}
      </div>
      </div>
    </div>
  </div>






  <!-- Modals -->

  <script type="text/ng-template" id="acceptPractitioner.html">
    <!-- <div class="modal reveal" data-reveal data-animation-in="spin-in" data-animation-out="spin-out"> -->
      <div class="modal" data-reveal data-animation-in="spin-in" data-animation-out="spin-out">
      <div class="modal__header modal__header--practitioner">
        <h1 class='title text-center'>Ben je zeker?</h1>
      </div>
      <div class="modal__content">
        <p class='text-center'>Je staat op het punt om <span>##practitioner.firstname## ##practitioner.lastname##</span> bij je praktijk toe te voegen.</p>

        <div class="modal__buttons m-t-60">
          <button class='button confirm' ng-click="ok()">Ja hoor!</button>
          <!-- <button class="button" ng-click="ok()">OK</button> -->
        </div>
      </div>
    </div>
  <!-- <h1>Zeker dat je ##practitioner.firstname##</h1> -->
  <!-- <h2>##practitioner.state.selectedPractitioner##</h2> -->


  <button ng-click="cancel()" class="close-button" aria-label="Close reveal" type="button">
    <span aria-hidden="true">&times;</span>
  </button>
  </script>

  <script type="text/ng-template" id="denyPractitioner.html">
    <!-- <div class="modal reveal" data-reveal data-animation-in="spin-in" data-animation-out="spin-out"> -->
      <div class="modal" data-reveal data-animation-in="spin-in" data-animation-out="spin-out">
      <div class="modal__header modal__header--practitioner">
        <h1 class='title text-center'>Ben je zeker?</h1>
      </div>
      <div class="modal__content">
        <p class='text-center'>Je staat op het punt om <span>##practitioner.firstname## ##practitioner.lastname##</span> te weigeren.</p>

        <div class="modal__buttons m-t-60">
          <button class='button confirm' ng-click="ok()">Begrepen</button>
          <!-- <button class="button" ng-click="ok()">OK</button> -->
        </div>
      </div>
    </div>
  <!-- <h1>Zeker dat je ##practitioner.firstname##</h1> -->
  <!-- <h2>##practitioner.state.selectedPractitioner##</h2> -->


  <button ng-click="cancel()" class="close-button" aria-label="Close reveal" type="button">
    <span aria-hidden="true">&times;</span>
  </button>
  </script>

  {{-- <div class="reveal" id="exampleModal1" data-reveal>
    <div class="" ng-controller='TestCtrl as test'>
      ##test.state.test##
      ja goeiendadg
      ##modal.state.selectedPractitioner##
      ##$parent.state.selectedPractitioner##
      <input type="text" ng-model='modal.state.selectedPractitioner.firstname' name="" value="">
    <h1>Awesome. I Have It.</h1>
    <p>##$parent.state.selectedPractitioner.firstname## I'm a cool paragraph that lives inside of an even cooler modal. Wins!</p>
    <button class="close-button" data-close aria-label="Close modal" type="button">
      <span aria-hidden="true">&times;</span>
    </button>
    </div>

</div> --}}

    {{-- <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in dd <strong>ADMINIOS</strong>
                </div>
            </div>
        </div>
    </div> --}}

@endsection
