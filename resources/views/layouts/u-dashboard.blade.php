<!DOCTYPE html>
<html lang="en" ng-app='sl'>
<head>
    <base href="/">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->


    <link rel='stylesheet prefetch' href='http://cdnjs.cloudflare.com/ajax/libs/semantic-ui/0.16.1/css/semantic.min.css'>

    <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.1.8/components/icon.min.css'>
    <!-- Dashboard Admin styles only -->
    <link href="{{ elixir('css/admin-app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/motion-ui/1.1.1/motion-ui.min.css" />



    <link href="{{ elixir('css/app.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>

    <div id="app" class='container' ng-controller='UserDashboardCtrl as user' ng-init='user.events.init();'>
      <div class="menu-wrap">
        @include('includes.sidemenu')
      </div>
      <div class="content-wrap">
        <div class="content">
          @include('includes.navbar')

          <div class="p-container p-container--bg-default-user" style='background-color: ##user.state.selectedColor##;'>
          <div class="dashboard m-t-60" >
          <div class="f-row row" data-equalizer data-equalize-on="medium">
          @include('user.includes.sidemenu')
          @yield('content')
          </div>
          </div>
          </div>

          @yield('footer')
        </div>

        {{-- @include('includes.footer') --}}
      </div>
    </div>

    <!-- Scripts -->
    <script async defer
   src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA2TtmcARObbsZdvdfKkXlYuGVvmnDadfE&libraries=places">
   </script>
      <script src="{{ elixir('js/libs.js') }}"></script>
      <script src="{{ elixir('js/app.js') }}"></script>
      <script src="{{ elixir('js/angular.js') }}"></script>
      @yield('scripts')



</body>
</html>
