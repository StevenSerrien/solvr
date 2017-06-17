@extends('layouts.u-dashboard')

@section('content')
      <div class="medium-8 large-10 xlarge-10 columns p-rel" data-equalizer-watch>
        <div class="dashboard--full-h dashboard__board dashboard-item-animated dashboard-item-animated--2 slide-in-from-bottom">
          <h1 class='text-center u-d-title u-d-t--main'>Vul hier jouw <span class='u-d-t--bold'>code</span> in</h1>
          <h2 class='text-center u-d-subtitle u-d-t--main u-d-t--color-2'>Die heb je normaal gekregen van je logopediste.</h2>

          <div class="row m-t-60">
            <div class="large-8 large-centered columns">
              <div class="row">
                @for ($i=0; $i < 4; $i++)
                  <div class="large-3 columns">
                    <input class='input-code' ng-model='user.state.code[{{$i}}].character' restrict="reject" mask="w" style='border-color: ##user.state.selectedColor##' type="text" name="" value="">
                  </div>
                @endfor

              </div>
            </div>

          </div>
        </div>


      </div>





@endsection
