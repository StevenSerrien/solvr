@extends('layouts.u-dashboard')

@section('content')
  <div class="medium-8 large-10 xlarge-10 columns p-rel" data-equalizer-watch>
    <div class="dashboard--full-h dashboard__board dashboard-item-animated dashboard-item-animated--2 slide-in-from-bottom">
      <h1 class='text-center u-d-title u-d-t--main'>Wat wil je doen <span class='u-d-t--bold'>vandaag?</span></h1>
      <h2 class='text-center u-d-subtitle u-d-t--main u-d-t--color-2'>Maak je keuze hieronder</h2>
      <div class="row m-t-80">
        <div class="large-8 large-centered columns">
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
          <div class="row m-t-40">
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
            </div>
            <div class="large-4 columns">
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
            </div>
            <div class="large-4 columns">

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
  $(document).on('ready', function() {

    $('.field').on('focus', function() {
      $('body').addClass('is-focus');
    });

    $('.field').on('blur', function() {
      $('body').removeClass('is-focus is-type');
    });

    $('.field').on('keydown', function(event) {
      $('body').addClass('is-type');
      if((event.which === 8) && $(this).val() === '') {
        $('body').removeClass('is-type');
      }
    });

  });
  </script>
@endsection
