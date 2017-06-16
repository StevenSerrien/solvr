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
          <div class="dashboard__divider dashboard__divider--full  m-b-20 m-t-20">
          </div>
          <ul class="u-d-sidemenu__stackedmnu vertical menu">
          <li><a ><i class='icon-home'></i></a></li>
          <li><a ><i class='icon-puzzle'></i></a></li>
          <li><a ><i class='icon-trophy'></i></a></li>




          </ul>
          </div>


        </div>
      </div>
      <div class="medium-8 large-10 xlarge-10 columns">
        <div class="dashboard__board dashboard-item-animated dashboard-item-animated--2 slide-in-from-bottom">
          <h1 class='text-center u-d-title u-d-t--main'>Wat wil je doen <span class='u-d-t--bold'>vandaag?</span></h1>
          <h2 class='text-center u-d-subtitle u-d-t--main u-d-t--color-2'>Maak je keuze hieronder</h2>
          <div class="row m-t-40">
            <div class="large-8 columns">
              <div class="row">
                <div class="large-4 columns">
                  <a class='choice-card-href' href="#">Rekenen</a>
                </div>
                <div class="large-4 columns">
                  <a class='choice-card-href' href="#">Spelling</a>
                </div>
                <div class="large-4 columns">
                  <a class='choice-card-href' href="#">Taal</a>
                </div>
              </div>
            </div>
            <div class="large-4 columns">


              <svg id='spelling' viewbox="0 0 36 36" class='progression-circle'>
                <path class="circle-bg"
                d="M18 2.0845
                a 15.9155 15.9155 0 0 1 0 31.831
                a 15.9155 15.9155 0 0 1 0 -31.831"
                />
                <path class='circle circle--spelling'
                d="M18 2.0845
                a 15.9155 15.9155 0 0 1 0 31.831
                a 15.9155 15.9155 0 0 1 0 -31.831"
                fill="none"
                stroke="#444";
                stroke-width="1";
                stroke-dasharray="75, 100"


                />
                <text x="18" y="20.35" class="percentage">60%</text>
              </svg>
              <svg id='rekenen' viewbox="0 0 36 36" class='progression-circle'>
                <path class="circle-bg"
                d="M18 2.0845
                a 15.9155 15.9155 0 0 1 0 31.831
                a 15.9155 15.9155 0 0 1 0 -31.831"
                />
                <path class='circle circle--taal'
                d="M18 2.0845
                a 15.9155 15.9155 0 0 1 0 31.831
                a 15.9155 15.9155 0 0 1 0 -31.831"
                fill="none"
                stroke="#444";
                stroke-width="1";
                stroke-dasharray="35, 100"
                />
                <text x="18" y="20.35" class="percentage">35%</text>
              </svg>
              <svg id='taal' viewbox="0 0 36 36" class='progression-circle'>
                <path class="circle-bg"
                d="M18 2.0845
                a 15.9155 15.9155 0 0 1 0 31.831
                a 15.9155 15.9155 0 0 1 0 -31.831"
                />
                <path class='circle circle--rekenen'
                d="M18 2.0845
                a 15.9155 15.9155 0 0 1 0 31.831
                a 15.9155 15.9155 0 0 1 0 -31.831"
                fill="none"
                stroke="#444";
                stroke-width="1";
                stroke-dasharray="15, 100"
                />
                <text x="18" y="20.35" class="percentage">15%</text>
              </svg>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>



@endsection

@section('scripts')

  <script type="text/javascript">
  // $(function() {
  //   var s = new Snap('#spelling');
  //   var ls = s.select('#spelling .circle');
  //
  //
  //   Snap.animate(0, 100, function( value ) {
  //     ls.attr({ 'stroke-dashoffset': value});
  //   }, 2000);
  //
  //   var r = new Snap('#rekenen');
  //   var lr = r.select('#rekenen .circle');
  //
  //   Snap.animate(0, 10, function( value ) {
  //     lr.attr({ 'stroke-dasharray': value});
  //   }, 2000);
    //
    // var s = new Snap('#spelling');
    // var ls = s.select('#spelling .circle');
    //
    // Snap.animate(0, 15, function( value ) {
    //   l.attr({ 'stroke-dasharray': value});
    // }, 2000);




  // });
  </script>
@endsection
