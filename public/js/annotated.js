var dependencies = [
  'df.services',
  'df.directives',
  'df.controllers',

  'ngAnimate',
  'ngRoute',
  'ngSanitize',
];

var df = {
  app: angular.module('df', dependencies),
  controllers: angular.module('df.controllers', []),
  directives: angular.module('df.directives', []),
  services: angular.module('df.services', [])
};

df.app.config(["$locationProvider", "$interpolateProvider", function($locationProvider, $interpolateProvider) {
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
}]);
