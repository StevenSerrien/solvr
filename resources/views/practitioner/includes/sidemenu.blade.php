<nav class='d-sidemenu'>
  <div class="profile-card">
    <div class="profile-card__avatar">

        <img data-name="{{ Auth::guard('practitioner')->user()->firstname }}" class="da-profile">
    <span class='status'></span>
    </div>
    <span class='profile-card__name'>{{ Auth::guard('practitioner')->user()->firstname }}</span>
    <span class='profile-card__function'>{{ Auth::guard('practitioner')->user()->practice->name }}</span>
    <a class='profile-card__edit-profile'><i class='icon-pencil'></i>Profiel wijzigen</a>
  </div>
  <span class='d-sidemenu__title'>Activiteiten</span>
  <ul class="d-sidemenu__stackedmnu vertical menu">
  <li><a href="#"><i class='icon-home'></i>Mijn praktijk</a></li>
  <li><a href="#"><i class='icon-puzzle'></i>Oefeningen</a></li>
  <li><a href="#"><i class='icon-users'></i>Clienten</a></li>
  </ul>
</nav>
