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
    <link href="{{ elixir('css/app.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>

    <div id="app" class='container'>
      <div class="menu-wrap">
        @include('includes.sidemenu')
      </div>
      <div class="content-wrap">
        <div class="content">
          @include('includes.navbar')
          @yield('content')
          @yield('footer')
        </div>

        {{-- @include('includes.footer') --}}
      </div>
    </div>

    <!-- Scripts -->
    <script async defer
   src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA2TtmcARObbsZdvdfKkXlYuGVvmnDadfE">
   </script>
      <script src="{{ elixir('js/libs.js') }}"></script>
      <script src="{{ elixir('js/app.js') }}"></script>
      <script src="{{ elixir('js/angular.js') }}"></script>
      @yield('scripts')

</body>
</html>
