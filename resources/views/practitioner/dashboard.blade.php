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
        <div class="dashboard__board">
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
              <a class='confirm' href="#"><i class='icon-check'></i></a>
              <a class='deny' href="#"><i class='icon-ban'></i></a>
            </div>
          </div>
        </div>
        </div>
      </div>
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
