@extends('layouts.app')

@section('content')

  <div class="jumbotron jumbotron--color-2 s-container">

    <div class="row f-row small-collapse">
      <div class="large-12 columns">
        <div class="jumbotron__content">
          <h1><span class='highlight highlight--color-2'>Logopedisten,</span><br>wij zijn er om te</h1>

        </div>
      </div>
    </div>

    <span class='jumbotron__big'>helpen</span>
  </div>

  <div class="s-container s-container--no-p">

    <div class="section section--color-1 m-t-120">
      <div class="section__header section__header--color-1">
        <div class="row f-row">
          <div class="large-12 columns">
            <h1 class='section__headertitle'>Wat als je je cliëntjes thuis<br>kan laten oefenen?</h1>
          </div>
        </div>
      </div>
      <div class="masonry" >
      <div class="row f-row" data-equalizer data-equalize-on="medium" >
        <div class="masonry__small-c large-6 columns" data-equalizer-watch>

        </div>
        <div class="masonry__big-c large-6 columns" data-equalizer-watch>
          <div class="masonry__big-inner">
            <h3 class='masonry__brand'>solvr</h3>
            {{-- <span class='masonry__subtitle'>Platform voor logopedisten</span> --}}
          </div>
        </div>

      </div>
      </div>
    </div>

  </div>
  {{-- <div class="c-container ">
    <div class="mixed-jumbo mixed-jumbo--shaped-circle m-t-60">
      <div class="mixed-jumbo__content">
        <div class="row">
          <div class="large-12 columns">
            <h1>Logopedisten, <br>deze is voor jullie.</h1>
          </div>
        </div>
      </div>
      <div class="mixed-jumbo__background mixed-jumbo__background--color-2">
      </div>
    </div>
    <div class="img-jumbo img-jumbo--cometboi m-t-60">
    </div>
  </div> --}}
@endsection
