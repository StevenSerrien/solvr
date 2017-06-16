@extends('layouts.u-dashboard')

@section('content')
      <div class="medium-8 large-10 xlarge-10 columns p-rel" data-equalizer-watch>
        <div class="dashboard--full-h dashboard__board dashboard-item-animated dashboard-item-animated--2 slide-in-from-bottom">
          <h1 class='text-center u-d-title u-d-t--main'>Bekijk hier al je <span class='u-d-t--bold'>trofeeën</span> !</h1>
          <h2 class='text-center u-d-subtitle u-d-t--main u-d-t--color-2'>Speel ze vrij door oefeningen te maken.</h2>

          <div class="row m-t-60">
            <div class="large-4 columns">
              <div class="achievement">
                <div class="achievement-wrapper">
                  <img src="../../img/achievement-spelling.svg" alt="">
                </div>
                <span class='block text-center u-d-t--main   u-d-t--color-1 u-d-board-title m-t-20 achievement-title'>spellingsheld</span>
                <span class='block text-center u-d-t--main u-d-t--color-2'>Vrijgespeeld op 01/02/2017</span>
              </div>
            </div>
            <div class="large-4 columns">
              <div class="achievement">
                <div class="achievement-wrapper">
                  <img src="../../img/achievement-locked.svg" alt="">
                </div>
                <span class='block text-center u-d-t--main   u-d-t--color-1 u-d-board-title m-t-20 achievement-title locked'>vergrendeld</span>
                <span class='block text-center u-d-t--main u-d-t--color-2'>Nog niet vrijgespeeld</span>
              </div>

            </div>
            <div class="large-4 columns">
              <div class="achievement">
                <div class="achievement-wrapper">
                  <img src="../../img/achievement-locked.svg" alt="">
                </div>
                <span class='block text-center u-d-t--main   u-d-t--color-1 u-d-board-title m-t-20 achievement-title locked'>vergrendeld</span>
                <span class='block text-center u-d-t--main u-d-t--color-2'>Nog niet vrijgespeeld</span>
              </div>
            </div>
          </div>
        </div>


      </div>





@endsection
