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
  {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

  <!-- Dashboard Admin styles only -->
  <link href="{{ elixir('css/admin-app.css') }}" rel="stylesheet">

  <!-- Scripts -->
  <script>
  window.Laravel = <?php echo json_encode([
    'csrfToken' => csrf_token(),
  ]); ?>
  </script>
</head>
<body>
  <div class="d-container" ng-controller='practitionerDashboardController as practitioner'>

    <div id='side-menu-wrap' class="sidemenu-wrap">
      <a id='d-sidemenu-close' class='d-sidemenu__btn d-sidemenu__btn--close icon-close'></a>
      @include('practitioner.includes.sidemenu')
    </div>
    <div class="content-wrap">
      @include('practitioner.includes.topbar')
      @yield('content')
    </div>

    
  </div>
  <!-- end d-container -->
  <!-- Scripts -->
  <script src="{{ elixir('js/libs.js') }}"></script>
  <script src="{{ elixir('js/d-app.js') }}"></script>
  <script src="{{ elixir('js/backend-libs.js') }}"></script>
  <script src="{{ elixir('js/angular.js') }}"></script>
  @yield('scripts')
</body>
</html>
