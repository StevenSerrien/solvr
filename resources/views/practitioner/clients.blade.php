@extends('layouts.dashboard')

@section('content')


  <div class="dashboard dashboard--practice m-t-60"  >
    <div class="row">
      <div class="large-12 columns">
        <div class="dashboard__headtag">
          <div class="badge badge--brand-color-1">
            <i class='icon-user-follow'></i>
          </div>
          <div class="content">
            <h1 class='content__title'>Clientenboard</h1>
            <span class='content__subtitle'>Hier kan je connecteren met je clienten</span>
          </div>
        </div>
      </div>

    </div>
    <div class="row m-t-80">
      <div class="large-6 columns">
        <div class="dashboard__board dashboard-item-animated dashboard-item-animated--1 slide-in-from-bottom">
          <h2 class='d--title'>Lijst van clienten waar u mee kan connecteren.</h2>
          <h3 class='d--subtitle'>Voeg ze toe om er mee te verbinden</h3>
          <div class="dashboard__divider dashboard__divider--small m-b-20">
          </div>
          @if (isset($users) && count($users) > 0)
            @foreach ($users as $user)
              <div class="dashboard__person m-b-10 clearfix">
                <div class="float-left">
                  <div class="avatar">
                   <ng-letter-avatar data="{{$user->firstname}}"></ng-letter-avatar>
                  </div>
                  <div class="content">
                    <span class='content__name d--text d-block'>{{$user->firstname}} {{$user->lastname}}</span>
                    <span class='content__riziv d--text d--block'>Geregistreerd op {{ \Carbon\Carbon::parse($user->created_at)->format('d/m/Y')}}</span>
                  </div>
                </div>
                <div class="float-right">
                  <div class="buttons">
                    <a class='confirm' href='{{ route('practitioner.clients.add', ['id' => $user->id]) }}' target='_self'><i class='icon-user-follow'></i></a>
                  </div>

                </div>

              </div>
            @endforeach
          @endif
        </div>

      </div>
      <div class="large-6 columns">
        <div class="dashboard__board dashboard-item-animated dashboard-item-animated--1 slide-in-from-bottom">
          <h2 class='d--title'>Lijst van clienten waar geconnecteerd mee bent.</h2>
          <h3 class='d--subtitle'>Je kan ze ook weer 'unlinken'</h3>
          <div class="dashboard__divider dashboard__divider--small m-b-20">
          </div>
          @if (isset($linkedUsers) && count($linkedUsers) > 0)
            @foreach ($linkedUsers as $user)
              <div class="dashboard__person m-b-10 clearfix">
                <div class="float-left">
                  <div class="avatar">
                   <ng-letter-avatar data="{{$user->firstname}}"></ng-letter-avatar>
                  </div>
                  <div class="content">
                    <span class='content__name d--text d-block'>{{$user->firstname}} {{$user->lastname}}</span>
                    <span class='content__riziv d--text d--block'>Geregistreerd op {{ \Carbon\Carbon::parse($user->created_at)->format('d/m/Y')}}</span>
                  </div>
                </div>
                <div class="float-right">
                  <div class="buttons">
                    <a class='confirm' href='{{ route('practitioner.clients.remove', ['id' => $user->id]) }}' target='_self'><i class='icon-user-unfollow'></i></a>
                  </div>

                </div>

              </div>
            @endforeach
          @endif
        </div>
      </div>
    </div>
    <div class="row m-t-40">

    </div>
  </div>



@endsection
