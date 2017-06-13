@extends('layouts.dashboard')

@section('content')
  <div class="dashboard dashboard--practice m-t-60" ng-init="practitioner.handlers.initPracticeView()" >
    <div class="row">
      <div class="large-12 columns">
        <div class="dashboard__headtag">
          <div class="badge badge--brand-color-1">
            <i class='icon-bell'></i>
          </div>
          <div class="content">
            <h1 class='content__title'>Uw persoonlijke notificaties</h1>
            <span class='content__subtitle'>Hier vindt u alle nieuwigheden over uw praktijk en profiel</span>
          </div>
        </div>
      </div>

    </div>
    <div class="row m-t-80">
      <div class=" large-12 columns">
        <div class="dashboard__board dashboard-item-animated dashboard-item-animated--2 slide-in-from-bottom">
          <h2 class='d--title'>Meldingen</h2>
          <h3 class='d--subtitle'>Klik op bijhorende knop om deze te markeren als gelezen.</h3>

        <div class="dashboard__divider dashboard__divider--small m-b-20">
        </div>
      @if (isset($notifications) && count($notifications) > 0)
        @foreach ($notifications as $notification)
            <div class="dashboard__item m-b-10 clearfix">
              <div class="float-left">
              <div class="badge">
                @if ($notification->data['type'] == 'contact')
                  <i class='icon-envelope-letter'></i>
                @endif

              </div>
              <div class="content">
                <span class='content__name d--text d-block'>{{ $notification->data['message']}}</span>
                <span class='content__content d--text d--block'>{{ $notification->data['action']}}</span>
              </div>
            </div>
            <div class="float-right">
              <div class="buttons">
                <a class='default' href=" {{ route('practitioner.notifications.read', $notification->id) }}" target="_self" ><i class='icon-eye'></i></a>
              </div>

            </div>
          </div>
        @endforeach
        <a href="{{ route('practitioner.notifications.read.all') }}" target="_self" ><button class='btn btn--frm btn--frm--color-2  m-t-60' type="button" name="button">alle meldingen lezen</button></a>
      @endif

      </div>
      </div>
    </div>
  </div>



@endsection
