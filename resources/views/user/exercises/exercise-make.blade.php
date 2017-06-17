@extends('layouts.u-dashboard')

@section('content')
      <div class="medium-8 large-10 xlarge-10 columns p-rel" data-equalizer-watch>
        <div class="dashboard--full-h dashboard__board dashboard-item-animated dashboard-item-animated--2 slide-in-from-bottom">
          <h1 class='text-center u-d-title u-d-t--main'>Oefening maken op <span class='u-d-t--bold u-d-t--lowercase'>{{$exercise->subcategory->name}}</span></h1>
          <h2 class='text-center u-d-subtitle u-d-t--main u-d-t--color-2'>{{$exercise->description}}</h2>


        </div>


      </div>





@endsection
