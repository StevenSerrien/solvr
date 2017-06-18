@extends('layouts.u-dashboard')

@section('content')
      <div class="medium-8 large-10 xlarge-10 columns p-rel" data-equalizer-watch>
        <div class="dashboard--full-h dashboard__board dashboard-item-animated dashboard-item-animated--2 slide-in-from-bottom">
          <h1 class='text-center u-d-title u-d-t--main'>Bekijk hier al je <span class='u-d-t--bold'>trofeeën</span> !</h1>
          <h2 class='text-center u-d-subtitle u-d-t--main u-d-t--color-2'>Speel ze vrij door oefeningen te maken.</h2>

          <div class="row ">
            <div class="large-4 columns">
              <div class="achievement m-t-20">
                @if ($exercisesCount >= 1)
                <div class="achievement-wrapper">
                <img src="../../img/achievement-spelling.svg" alt="">
                </div>
                <span class='block text-center u-d-t--main   u-d-t--color-1 u-d-board-title m-t-20 achievement-title'>oefenheld</span>
                @else
                  <div class="achievement-wrapper">
                    <img src="../../img/achievement-locked.svg" alt="">
                  </div>
                  <span class='block text-center u-d-t--main   u-d-t--color-1 u-d-board-title m-t-20 achievement-title locked'>vergrendeld</span>
                @endif
              </div>
            </div>
            @for ($i=0; $i < 5 ; $i++)
              <div class="large-4 columns">
                <div class="achievement m-t-20">
                  <div class="achievement-wrapper">
                    <img src="../../img/achievement-locked.svg" alt="">
                  </div>
                  <span class='block text-center u-d-t--main   u-d-t--color-1 u-d-board-title m-t-20 achievement-title locked'>vergrendeld</span>
                </div>
              </div>
            @endfor
          </div>
        </div>


      </div>





@endsection
