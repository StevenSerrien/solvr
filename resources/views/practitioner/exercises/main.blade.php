@extends('layouts.dashboard')

@section('content')
  <div class="dashboard dashboard--practice m-t-60 p-b-60" ng-controller='ExercisePractitionerCtrl as pexercise' >
    <div class="row">
      <div class="large-12 columns">
        <div class="dashboard__headtag">
          <div class="badge badge--brand-color-1">
            <i class='icon-puzzle'></i>
          </div>
          <div class="content">
            <h1 class='content__title'>Uw oefeningen</h1>
            <span class='content__subtitle'>Maak nieuwe oefeningen of bekijk jouw eerder gemaakte.</span>
          </div>
        </div>
      </div>

    </div>
    <div class="row m-t-80">
      <div class=" large-4 columns">
        <div class="dashboard__board dashboard-item-animated dashboard-item-animated--1 slide-in-from-bottom">
          <h2 class='d--title'>Wil je een nieuwe oefening maken?</h2>
          <h3 class='d--subtitle'>Selecteer een categorie.</h3>
          <div class="dashboard__divider dashboard__divider--small m-b-20">
          </div>
          <form name='selectCategoryForm'>
          {{ csrf_field() }}

          @if (isset($categories) && count($categories) > 0)
            @foreach ($categories as $category )
              <input class='choice-card' type="radio" name="categoryId" ng-model='pexercise.state.selectedCategory' value="{{$category->id}}" id="cu-newpractice-{{$category->id}}" required>
              <label class='m-t-40' for="cu-newpractice-{{$category->id}}"><span>{{ $category->name}}</span></label>
            @endforeach
          @endif
            <a  href="{{ route('practitioners.exercises.make.show', ['category_id' => '##pexercise.state.selectedCategory##']) }}" target='_self'><button type="button" ng-disabled='selectCategoryForm.$invalid' class='m-t-20 btn btn--frm btn--frm--color-2 btn--block' name="button">aanmaken</button></a>
          </form>


        </div>
      </div>
      <div class=" large-8 columns">
        <div class="dashboard__board dashboard-item-animated dashboard-item-animated--2 slide-in-from-bottom">
          <h2 class='d--title'>Dit zijn jouw eerder gemaakte oefeningen.</h2>
          <h3 class='d--subtitle'>Wijzig ze of raad ze aan.</h3>
          <div class="dashboard__divider dashboard__divider--small m-b-20">
          </div>


        </div>
      </div>
    </div>
  </div>



@endsection
