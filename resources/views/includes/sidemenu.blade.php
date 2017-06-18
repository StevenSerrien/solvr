<nav class="sidemenu">
  <div class="illustration illustration--header menu c-block">
  </div>
  @if (Auth::guard('practitioner')->user())
    <div class="sidemenu-cat">
      <span>hallo, {{Auth::guard('practitioner')->user()->firstname}}</span>
    </div>
    <div class="sidemenu-list m-b-20">
      <a href="{{ route('practitioner.dashboard') }}" target="_self"><span>mijn dashboard</span></a>
      <a href="{{ url('/logout') }}" target="_self"><span>uitloggen</span></a>
    </div>
    <div class="sidemenu-cat">
      <span>Waar wil je heen?</span>
    </div>
  @elseif (Auth::guard('web')->user())
    <div class="sidemenu-cat">
      <span>hoi, {{Auth::guard('web')->user()->firstname}}</span>
    </div>
    <div class="sidemenu-list m-b-20">
      <a href="{{ route('user.dashboard') }}" target="_self"><span>mijn dashboard</span></a>
      <a href="{{ url('/logout') }}" target="_self"><span>uitloggen</span></a>
    </div>
    <div class="sidemenu-cat">
      <span>Waar wil je heen?</span>
    </div>
  @endif
  <div class="sidemenu-list m-b-20">
    <a href="{{ route('about') }}" target="_self"><span>over ons</span></a>
    <a href="{{ route('therapists') }}" target="_self"><span>logopedisten</span></a>
    <a href="{{ route('search.practitioner.show') }}"  target="_self"><span>zoeken</span></a>

    @if (!Auth::guard('practitioner')->user() && !Auth::guard('web')->check())
      <a href="{{ route('user.register.show') }}" target="_self"><span>registreren</span></a>
      <a href="{{ route('practitioner.register.show') }}" target="_self"><span>registreren als logo</span></a>
    @endif



  </div>
  <div class="sidemenu__footer">
    <span>Made with   <i class='icon i-heart'></i></span>
  </div>
</nav>
{{-- <button class="close-button" id="close-button">Close Menu</button> --}}
{{-- <div class="morph-shape" id="morph-shape" data-morph-open="M-1,0h101c0,0,0-1,0,395c0,404,0,405,0,405H-1V0z">
  <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 100 800" preserveAspectRatio="none">
    <path d="M-1,0h101c0,0-97.833,153.603-97.833,396.167C2.167,627.579,100,800,100,800H-1V0z"/>
  </svg>
</div> --}}
