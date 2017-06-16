<div class="medium-4 large-2 xlarge-2 columns p-rel" data-equalizer-watch data-equalize-on="medium">
  <div class="dashboard--full-h dashboard__board dashboard-item-animated dashboard-item-animated--1 slide-in-from-bottom">
    <div class="u-profile-card">


    <div class="u-avatar-wrap">
      <img src="http://api.adorable.io/avatars/285/sofie" alt="">
    </div>
    <div class="dashboard__divider dashboard__divider--full  m-b-20 m-t-20">
    </div>

    <span class='text-center u-d-board-title u-d-t--main u-d-t--color-1 block m-b-40'><span class='u-d-t--secundary t--color-2 u-d-t--bold'>Hoi, </span>Steven</span>
    <div class="u-color-picker">
      <ngjs-color-picker ng-click='user.handlers.changeColorscheme();' selected-color="user.state.selectedColor"  custom-colors='user.state.colorschemes' options='user.state.ngjsColorPicker.options' required></ngjs-color-picker>
    </div>
    <div class="dashboard__divider dashboard__divider--full  m-b-20 m-t-20">
    </div>
    <ul class="u-d-sidemenu__stackedmnu vertical menu">
    <li><a class='{{ active_route('user.dashboard') }}' href='{{ route('user.dashboard')}}' target='_self'><i class='icon-home'></i></a></li>
    <li><a ><i class='icon-puzzle'></i></a></li>
    <li><a class='{{ active_route('user.achievements') }}' href='{{ route('user.achievements')}}' target='_self'><i class='icon-trophy'></i></a></li>




    </ul>
    </div>


  </div>
</div>
