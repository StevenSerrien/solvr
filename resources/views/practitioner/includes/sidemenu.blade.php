<nav class='d-sidemenu'>
  <div class="profile-card">
    <div class="profile-card__avatar">
      <ng-letter-avatar data="{{ Auth::guard('practitioner')->user()->firstname }}"></ng-letter-avatar>
        {{-- <img data-name="{{ Auth::guard('practitioner')->user()->firstname }}" class="da-profile"> --}}
    <span class='status'></span>
    </div>
    <span class='profile-card__name'>{{ Auth::guard('practitioner')->user()->firstname }}</span>
    <span class='profile-card__function'>{{ Auth::guard('practitioner')->user()->practice->name }}</span>
    <a class='profile-card__edit-profile'><i class='icon-pencil'></i>Profiel wijzigen</a>
  </div>
  <span class='d-sidemenu__title'>Activiteiten</span>
  <ul class="d-sidemenu__stackedmnu vertical menu">
  <li><a class='item {{ active_route('practitioner.dashboard') }}' href="{{ route('practitioner.dashboard') }}" target="_self"><i class='icon-home'></i>Mijn praktijk</a></li>
  <li><a class='item {{ active_route('practitioners.exercises.show') }}' href="{{ route('practitioners.exercises.show') }}" target="_self"><i class='icon-puzzle'></i>Oefeningen</a></li>
  <li><a class='item {{ active_route('practitioner.clients.show') }}' href="{{ route('practitioner.clients.show') }}" target="_self"><i class='icon-users'></i>Clienten</a></li>
  <li><a class='item {{ active_route('practitioner.notifications.show') }}' href="{{ route('practitioner.notifications.show') }}" target="_self"><i class='icon-bell'></i>Meldingen</a></li>

  <li class='m-t-40'><a class='' href="{{  url('/logout') }}" target="_self"><i class='icon-logout'></i>Uitloggen</a></li>

  </ul>
</nav>
