@extends('layouts.app')

@section('content')
<div ng-controller='SearchCtrl as search' ng-init='search.events.init()' class="">


  <div class="jumbotron jumbotron--color-3 s-container jumbotron--animated-v">

    <div class="row f-row small-collapse">
      <div class="large-12 columns">
        <div class="jumbotron__content">
          <h1 class='jumbotron--animated jumbotron--animated-1'>Ben je op <span class='highlight highlight--color-1'>zoek</span></h1>
          <h1 class='jumbotron--animated jumbotron--animated-2'>naar professionele</h1>

        </div>
      </div>
    </div>

    <span class='jumbotron__big jumbotron--animated jumbotron--animated-3'>hulp</span>
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
      <div class="row f-row search" data-equalizer data-equalize-on="medium">
        <div class="large-4 columns" data-equalizer-watch>
          <form name='searchLogoForm'>


          <div class="search__search-block">
            <div class="input-grp">
              <label class='main-label t--semi-bold ' for="">Vul jouw <span class='highlight'>adres</span> in</label>
              <label class='sub-label t--lightest m-b-30' for="">Wij berekenen de afstand</label>
              <input id="autocomplete2" name='address' class='input--stnrd' type="text" ng-model='search.state.selectedAddress' placeholder="Vul je adres in" ng-init='search.googleHandlers.initAutocomplete()' autocomplete="off" required >

            </div>
            <div class="input-grp m-t-60">
              <label class='main-label t--semi-bold ' for="">Zoek je ook <span class='highlight'>specialisaties</span></label>
              <label class='sub-label t--lightest m-b-30' for="">Je kan ze ook leeg laten</label>
              <so-dropdown-multiple class='cst-dropdown' name='specialities' ng-change='' ng-model="search.state.datatosend.selectedSpecialities" placeholder='Voeg specialiteiten toe' dropdown-items="search.state.specialities" required>
                <option value='None'>None</option>
              </so-dropdown-multiple>
            </div>
            <button type="button" class='btn btn--frm btn--block m-t-60' ng-click='search.handlers.getAllPracticesBySpecialities()' name="button">zoeken</button>
            </form>
          </div>
        </div>
        <div class="large-8 columns p-rel" data-equalizer-watch>
          <div id="map_canvas">
            <ui-gmap-google-map events='search.state.map.events' center="search.state.map.center" options='search.state.map.options' zoom="search.state.map.zoom">
                <ui-gmap-markers models="search.state.practices" options="search.state.marker.options" coords="'self'" click="search.markerhandlers.onClick">
                  <ui-gmap-windows show="show">
                    <div class='cst-map-window' ng-non-bindable>
                        <span class='cst-map-window__name'>##name##</span>
                        <span class='cst-map-window__distance'>##streetname## ##housenumber## <br> ##locality## ##postal_code##</span>
                        <span class='cst-map-window__distance'>##distance## km</span>
                        <a href="{{ route('contact.practice', ['id' => '##id##'])}}" target="_self"><button type="button" class='btn btn--frm btn--block m-t-20' name="button">contacteren</button></a>
                    </div>
                  </ui-gmap-windows>
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
