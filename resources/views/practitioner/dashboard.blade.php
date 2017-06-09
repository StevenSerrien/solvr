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
        <div class="dashboard__board ">
          <h2 class='d--title'>Uw praktijk ##practitioner.state.practice.name##</h2>
          <h3 class='d--subtitle'>U bent bevestigd door deze praktijk.</h3>
          <div class="dashboard__divider dashboard__divider--small">
          </div>
          <div ng-repeat="lPractitioners in practitioner.state.unconfirmedPractitioners" ng-init="$last ? practitioner.handlers.test() : angular.noop()" ng-cloak>
            <div class="dashboard__person m-b-10">
              <div class="avatar">
                <img data-name="##lPractitioners.firstname##" class="p-profile" alt="">
                ##lPractitioners.firstname##
              </div>
              <div class="content">
                <span class='content__name d--text d-block'>##lPractitioners.firstname## ##lPractitioners.lastname##</span>
                <span class='content__riziv d--text d--block'>Rizivnumber</span>
              </div>
            </div>
          </div>
          {{-- <div ng-repeat="lPractitioner in practitioner.state.linkedPractitioners" ng-cloak>
            gelinkt hoor
          </div> --}}

        </div>

      </div>
      <div class="dashboard__board large-6 columns">

      </div>
    </div>
  </div>


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
