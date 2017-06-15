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
    <form name='exerciseCreateForm'>


    <div class="row m-t-80">
      <div class="large-12 columns">
        <div class="dashboard__board dashboard-item-animated dashboard-item-animated--1 slide-in-from-bottom">
          <div class="row">
            <div class="large-12 columns">
              <h3 class='t--regular text-center m-b-40'>Algemene info <span class='highlight highlight--color-1'>oefening</span></h3>
            </div>
          </div>
          <div class="row">
            <div class="large-4 columns">
              <div class="step-block step-block--border-right">
                <span class='step-block__b-number'>01.</span>
                <h3 class='step-block__title'>Kies een subcategorie</h3>
                <so-dropdown-normal class='cst-dropdown cst-dropdown--full-w'  ng-change="pexercise.handlers.checkIfFirstStepsAreChosen()" ng-model="pexercise.state.datatosend.selectedSubCategoryID" placeholder='Selecteer een subcategorie' dropdown-items="pexercise.state.subCategories" required>
                  <option value='None'>None</option>
                </so-dropdown-normal>
              </div>
            </div>
            <div class="large-4 columns">
              <div class="step-block step-block--border-right">
                <span class='step-block__b-number'>02.</span>
                <h3 class='step-block__title'>Kies een thema kleur</h3>
                <div class="color-picker">
                 <ngjs-color-picker selected-color="pexercise.state.datatosend.selectedColor"  custom-colors='pexercise.state.colors.codes' options='pexercise.state.ngjsColorPicker.options' required></ngjs-color-picker>
                 </div>
              </div>
            </div>
            <div class="large-4 columns">
              <div class="step-block">
                <span class='step-block__b-number'>03.</span>
                <h3 class='step-block__title'>Kies een leeftijdsgroep</h3>
                <so-dropdown-ages class='cst-dropdown cst-dropdown--full-w' ng-change='pexercise.handlers.checkIfFirstStepsAreChosen()' ng-model="pexercise.state.datatosend.selectedAgeRange" placeholder='Selecteer een leeftijdsgroep' dropdown-items="pexercise.state.ageRanges" required>
                  <option value='None'>None</option>
                </so-dropdown-ages>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Step 2 -->
    <div class="row m-t-80">
      <div class="large-12 columns" ng-if="pexercise.state.datatosend.selectedColor !== undefined && pexercise.state.datatosend.selectedSubCategoryID !== undefined && pexercise.state.datatosend.selectedAgeRange !== undefined">
        <div class="dashboard__board dashboard-item-animated dashboard-item-animated--1 slide-in-from-bottom">
          <div class="row">
            <div class="large-12 columns">
              <h3 class='t--regular text-center m-b-40'>Geef je oefening zijn <span class='highlight highlight--color-1'>details</span></h3>
            </div>
          </div>
          <div class="row">
            <div class="large-4 columns">
              <div class="step-block">
                <h3 class='step-block__title'>Een naam</h3>
                @if ($category->name == 'Rekenen')
                  <h4 class='step-block__subtitle'>Zoals: 'Breuken op het piratenschip'</h4>
                @elseif ($category->name == 'Spelling')
                  <h4 class='step-block__subtitle'>Zoals: 'Verlengingsregel met d of t'</h4>
                @elseif ($category->name == 'Taal')
                  <h4 class='step-block__subtitle'>Zoals: 'Zoek de persoonsvorm'</h4>
                @endif

                <input class='input--stnrd' name='name'  type="text" ng-model='pexercise.state.datatosend.exercise.title' placeholder="Oefening naam" autocomplete="off" ng-minlength="3" required >
              </div>
            </div>
            <div class="large-8 columns">
              <div class="step-block">
                <h3 class='step-block__title'>Een beschrijving</h3>
                <h4 class='step-block__subtitle'>Dit kan bijvoorbeeld zijn: Maak een ja/nee-vraag om de persoonsvorm (PV) te vinden.</h4>
                <input class='input--stnrd' name='description'  type="text" ng-model='pexercise.state.datatosend.exercise.description' placeholder="Instructies voor het voltooien" ng-minlength="3" autocomplete="off" required >

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Step 3 -->
    <div class="row m-t-80">
      <div class="large-12 columns" ng-if="pexercise.state.datatosend.exercise.title !== undefined && pexercise.state.datatosend.exercise.description !== undefined">
      {{-- <div class="large-12 columns" > --}}

        <div class="large-12 columns" >
        <div class="dashboard__board dashboard-item-animated dashboard-item-animated--1 slide-in-from-bottom">
          <div class="row">
            <div class="large-12 columns">
              <h3 class='t--regular text-center '>Vul nu je <span class='highlight highlight--color-1'>vragen en antwoorden</span> in</h3>
              <h4 class='t--lightest t--regular text-center m-b-40'>Geef telkens een goed antwoord en een fout antwoord.</span></h4>
            </div>
          </div>
          <div class="row" ng-repeat="field in pexercise.state.datatosend.questions track by $index">
            <div class="step-block">
            <div class="large-12 columns">
              <h3 class='step-block__title'>Stel vraag ##$index + 1## op.</h3>
            </div>
            <div class="row" vertilize-container>
              <div class="large-11 columns" verilize>
                <div class="row">
                  <div class="large-6 columns">
                      <input class='input--stnrd' name='description'  type="text" ng-model="pexercise.state.datatosend.questions[$index].question" placeholder="Formuleer je vraag" ng-minlength="3" autocomplete="off" required >
                    </div>
                  @for ($i=0; $i < 2 ; $i++)
                    @if ($i == 0)
                      <div class="large-3 columns">
                        <input class='input--stnrd' name='description'  type="text" ng-model="pexercise.state.datatosend.questions[$index].answers.correct" placeholder="Correcte keuze"  autocomplete="off" required >
                      </div>
                    @elseif ($i == 1)
                      <div class="large-3 columns">
                        <input class='input--stnrd' name='description'  type="text" ng-model="pexercise.state.datatosend.questions[$index].answers.false" placeholder="Andere keuze"  autocomplete="off" required >
                      </div>
                    @endif
                  @endfor
                </div>
              </div>
              <div class="large-1 columns" vertilize>
                <a ng-click="pexercise.handlers.removeQuestion('##$index##')"><i class='icon-close'></i></a>
              </div>
            </div>

          </div>
          </div>
          <div class="row">
            <div class="large-12 columns">
              <a ng-click='pexercise.handlers.addNewQuestion()'  class='icon-btn icon-btn--color-1'><i class='icon-plus'></i></a>
            </div>
          </div>

        </div>
      </div>
    </div>
    </form>
  </div>
  <div class="row m-t-120">
    <div class="large-4 columns">
      <a href="{{ URL::previous() }}" target='_self' ><button class='d-button d-button--greyed-out d-button--block' type="button" name="button">Annuleer</button></a>
    </div>
    <div class="large-4 columns">
      <button ng-click='pexercise.handlers.createExercise()' ng-disabled='exerciseCreateForm.$invalid || pexercise.state.datatosend.selectedColor == undefined' class='d-button d-button--default d-button--block' type="button" name="button">bewaar</button>
    </div>
    <div class="large-4 columns">
      <button ng-click='pexercise.handlers.createExercise()' ng-disabled='exerciseCreateForm.$invalid || pexercise.state.datatosend.selectedColor == undefined' class='d-button d-button--default d-button--block' type="button" name="button">publiceer</button>
    </div>
  </div>
</div>



@endsection
