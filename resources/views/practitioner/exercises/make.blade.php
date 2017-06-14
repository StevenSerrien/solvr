@extends('layouts.dashboard')

@section('content')
  <div class="dashboard dashboard--practice m-t-60 p-b-60" ng-controller='ExercisePractitionerCtrl as pexercise' ng-init='pexercise.events.init( {{$category}}, {{$ageRanges}})'>
    <div class="row">
      <div class="large-12 columns">
        <div class="dashboard__headtag">
          <div class="badge badge--brand-color-1">
            <i class='icon-notebook'></i>
          </div>
          <div class="content">
            <h1 class='content__title'>Laten we een oefening maken voor {{$category->name}}</h1>
            <span class='content__subtitle'>Volg de stappen.</span>
          </div>
        </div>
      </div>

    </div>
    <div class="row m-t-80">
      <div class="large-12 columns">
        <div class="dashboard__board dashboard-item-animated dashboard-item-animated--1 slide-in-from-bottom">
          <div class="row">
            <div class="large-4 columns">
              <div class="step-block step-block--border-right">
                <span class='step-block__b-number'>01.</span>
                <h3 class='step-block__title'>Kies een subcategorie</h3>
                <so-dropdown-normal class='cst-dropdown cst-dropdown--full-w'  ng-change="" ng-model="pexercise.state.datatosend.selectedSubCategoryID" placeholder='Selecteer een subcategorie' dropdown-items="pexercise.state.subCategories">
                  <option value='None'>None</option>
                </so-dropdown-normal>
              </div>
            </div>
            <div class="large-4 columns">
              <div class="step-block step-block--border-right">
                <span class='step-block__b-number'>02.</span>
                <h3 class='step-block__title'>Kies een thema kleur</h3>
                <div class="color-picker">
                 <ngjs-color-picker selected-color="pexercise.state.datatosend.selectedColor" custom-colors='pexercise.state.colors.codes' options='pexercise.state.ngjsColorPicker.options'></ngjs-color-picker>
                 </div>
              </div>
            </div>
            <div class="large-4 columns">
              <div class="step-block">
                <span class='step-block__b-number'>03.</span>
                <h3 class='step-block__title'>Kies een leeftijdsgroep</h3>
                <so-dropdown-ages class='cst-dropdown cst-dropdown--full-w' ng-model="pexercise.state.datatosend.selectedAgeRange" placeholder='Selecteer een leeftijdsgroep' dropdown-items="pexercise.state.ageRanges">
                  <option value='None'>None</option>
                </so-dropdown-ages>
              </div>
            </div>
          </div>
        </div>



      </div>
    </div>

  </div>
</div>



@endsection
