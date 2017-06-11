@extends('layouts.app')

@section('content')
<div ng-controller='SearchCtrl as search' ng-init='search.events.init()' class="">


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
    <div class="s-container s-container--no-p s-container--no-bg-color">
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
          <div id="map_canvas">
            <ui-gmap-google-map events='search.state.map.events' center="search.state.map.center" options='search.state.map.options' zoom="search.state.map.zoom">
                <ui-gmap-markers models="search.state.practices" options="search.state.marker.options" coords="'self'" click="search.markerhandlers.onClick">
                </ui-gmap-markers>
            </ui-gmap-google-map>
          </div>
        </div>
      </div>


    </div>
  </div>


</div>
@endsection
@section('footer')
  @include('includes.footer')
@endsection
@section('scripts')
  {{-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA2TtmcARObbsZdvdfKkXlYuGVvmnDadfE&libraries=places"
  async defer></script> --}}
@endsection
