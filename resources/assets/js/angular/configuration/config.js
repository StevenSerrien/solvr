df.app.config(function($locationProvider, $interpolateProvider) {
  var supports_history_api = function() {
    return !!(window.history && history.pushState);
  };

  $interpolateProvider.startSymbol('##');
  $interpolateProvider.endSymbol('##');
    if (supports_history_api()) {
      $locationProvider.html5Mode(true);
    } else {
      $locationProvider.html5Mode(false);
    }
});
