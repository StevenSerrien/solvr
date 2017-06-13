@extends('layouts.dashboard')

@section('content')
  <div class="dashboard dashboard--practice m-t-60" ng-init="practitioner.handlers.initPracticeView()" >
    <div class="row">
      <div class="large-12 columns">
        <div class="dashboard__headtag">
          <div class="badge badge--brand-color-1">
            <i class='icon-puzzle'></i>
          </div>
          <div class="content">
            <h1 class='content__title'>Uw oefeningen</h1>
            <span class='content__subtitle'>Maak nieuwe oefeningen of bekijk jouw eerder gemaakte.</span>
          </div>
        </div>
      </div>

    </div>
    <div class="row m-t-80">
      <div class=" large-12 columns">

      </div>
    </div>
  </div>



@endsection
