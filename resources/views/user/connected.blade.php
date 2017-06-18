@extends('layouts.u-dashboard')

@section('content')
      <div class="medium-8 large-10 xlarge-10 columns p-rel" data-equalizer-watch>
        <div class="dashboard--full-h dashboard__board dashboard-item-animated dashboard-item-animated--2 slide-in-from-bottom">
          <h1 class='text-center u-d-title u-d-t--main'>Met welke <span class='u-d-t--bold'>logopedist</span> ben je verbonden?</h1>
          <h2 class='text-center u-d-subtitle u-d-t--main u-d-t--color-2'>Dat kan je hier zien.</h2>
          <div class="row m-t-100">


          @if ($hasPractitioner)
            <div class="large-8 large-centered columns">
              <div class="row">
                <div class="large-4 columns">
                  <div class="letter-avatar" style='background-color: ##user.state.selectedColor##;'>
                    <div class="letter">
                      {{$linkedPractitioner->firstname[0]}}
                    </div>
                  </div>
                </div>
                <div class="large-8 columns">
                  <h2 class='u-d-board-title u-d-t--main u-d-t--color-1'><span class='u-d-t--color-1'>{{$linkedPractitioner->firstname}} {{$linkedPractitioner->lastname}}</span></h2>
                  <div class="dashboard__divider dashboard__divider--small  m-b-10 m-t-10"></div>
                  <span class='block u-d-board-subtitle u-d-t--main u-d-t--color-2'>Praktijk: <span class='u-d-t--bold'>{{$practice->name}}</span></span>
                  <span class='block u-d-board-subtitle u-d-t--main u-d-t--color-2'>{{$practice->streetname}} {{$practice->housenumber}}</span>
                  <span class='block u-d-board-subtitle u-d-t--main u-d-t--color-2'>{{$practice->postal_code}} {{$practice->locality}}</span>
                </div>
              </div>
            </div>
          @else
            <div class="large-8 large-centered columns">
              <div class="row">
                <h2 class='text-center u-d-board-title u-d-t--main u-d-t--color-1'><span class='u-d-t--color-1'>Je bent nog niet verbonden.</span></h2>
                <h2 class='text-center u-d-board-subtitle u-d-t--main u-d-t--color-1'><span class='u-d-t--color-1'>Vraag je logopedist om te verbinden.</span></h2>


              </div>
            </div>
          @endif


            {{-- <div class="large-8 columns">
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

            </div> --}}
            {{-- <div class="large-12 columns">
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

              <div class="u-block  m-t-20" style='border-color: ##user.state.selectedColor##;'>

              </div>
              <div class="u-block  m-t-20" style='border-color: ##user.state.selectedColor##;'>

              </div>
            </div> --}}

          </div>
        </div>


      </div>





@endsection
