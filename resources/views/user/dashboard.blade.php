@extends('layouts.u-dashboard')

@section('content')
      <div class="medium-8 large-10 xlarge-10 columns p-rel" data-equalizer-watch>
        <div class="dashboard--full-h dashboard__board dashboard-item-animated dashboard-item-animated--2 slide-in-from-bottom">
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
              <div class="row m-t-60">
                <div class="large-8 columns">
                  <h2 class='u-d-board-title u-d-t--main u-d-t--color-2'>Graag verbinden met je <span class='u-d-t--color-1 u-d-t--bold'>logopedist</span>?</h2>
                  <div class="dashboard__divider dashboard__divider--small  m-b-20 m-t-20"></div>
                </div>
                <div class="large-4 columns">
                  <fieldset class="field-container">
                    <input type="text" placeholder="Zoek op naam" class="field" />
                    <div class="icons-container">
                      <div class="icon-search"></div>

                    </div>
                  </fieldset>

                </div>
                <div class="large-12 columns">
                  <div class="dashboard__item u-block-wrapper clearfix m-t-20">
                    <div class="float-left">
                      <div class="u-block" style='border-color: ##user.state.selectedColor##;'>
                        <span class='block u-d-t--color-1 u-d-t--main'>Sofie Declau</span>
                        <span class='block u-d-t--color-2 u-d-t--main '>Praktijk <span class='u-d-t--bold'>Logokids</span></span>
                      </div>
                    </div>
                    <div class="float-right">
                      <div class="buttons">
                        <a class='default' href ng-click=''><i class='icon-user-follow'></i></a>
                      </div>
                    </div>
                  </div>
                  <div class="dashboard__item u-block-wrapper clearfix m-t-20">
                    <div class="float-left">
                      <div class="u-block" style='border-color: ##user.state.selectedColor##;'>
                        <span class='block u-d-t--color-1 u-d-t--main'>Silke Auwers</span>
                        <span class='block u-d-t--color-2 u-d-t--main '>Praktijk <span class='u-d-t--bold'>Vlinder</span></span>
                      </div>
                    </div>
                    <div class="float-right">
                      <div class="buttons">
                        <a class='default' href ng-click=''><i class='icon-user-follow'></i></a>
                      </div>
                    </div>
                  </div>
                  <div class="dashboard__item u-block-wrapper clearfix m-t-20">
                    <div class="float-left">
                      <div class="u-block" style='border-color: ##user.state.selectedColor##;'>
                        <span class='block u-d-t--color-1 u-d-t--main'>Joris Melaerts</span>
                        <span class='block u-d-t--color-2 u-d-t--main '>Praktijk <span class='u-d-t--bold'>Jogoris</span></span>
                      </div>
                    </div>
                    <div class="float-right">
                      <div class="buttons">
                        <a class='default' href ng-click=''><i class='icon-user-follow'></i></a>
                      </div>
                    </div>
                  </div>

                  {{-- <div class="u-block  m-t-20" style='border-color: ##user.state.selectedColor##;'>

                  </div>
                  <div class="u-block  m-t-20" style='border-color: ##user.state.selectedColor##;'>

                  </div> --}}
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
