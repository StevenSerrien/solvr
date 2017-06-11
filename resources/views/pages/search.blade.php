@extends('layouts.app')

@section('content')

  <div class="jumbotron jumbotron--color-3 s-container">

    <div class="row f-row small-collapse">
      <div class="large-12 columns">
        <div class="jumbotron__content">
          <h1>Ben je op <span class='highlight highlight--color-1'>zoek</span> <br>naar professionele</h1>

        </div>
      </div>
    </div>

    <span class='jumbotron__big'>hulp</span>
  </div>







  <div class="s-container s-container--no-p">
    <div class="section__header section__header--color-1 m-t-100">
      <div class="row f-row">
        <div class="large-12 columns">
          <h1 class='section__headertitle'>Nog geen logopedist, <br> maar zoek je er nog één?</h1>
        </div>
      </div>
    </div>
  </div>
  <div class="full-width-container full-width-container--w-shapes-1">
    <div class="s-container s-container--no-p">
      <div class="row f-row search">
        <div class="large-4 columns">
          <div class="search__search-block">
            <div class="input-grp">
              <label class='main-label t--semi-bold ' for="">Vul jouw <span class='highlight'>adres</span> in</label>
              <label class='sub-label t--lightest m-b-30' for="">Wij doen de rest</label>
              <input class='input--stnrd' type="text" placeholder="Voornaam" autocomplete="off" required >
            </div>
            <div class="input-grp m-t-60">
              <label class='main-label t--semi-bold ' for="">Zoek je ook <span class='highlight'>specialisaties</span></label>
              <label class='sub-label t--lightest m-b-30' for="">Wij doen de rest</label>
              <input class='input--stnrd' type="text" placeholder="Voornaam" autocomplete="off" required >
            </div>

          </div>
        </div>
        <div class="large-8 columns">

        </div>
      </div>


    </div>
  </div>



@endsection
@section('footer')
  @include('includes.footer')
@endsection
