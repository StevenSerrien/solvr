var dependencies = [
  'sl.services',
  'sl.directives',
  'sl.controllers',

  'angular-loading-bar',
  'ngAnimate',
  'ngRoute',
  'ngSanitize',
  'angular.vertilize',
  'ngMask',
  'validation.match',
  'ngLetterAvatar',
  'mm.foundation',
  'ngTouch'
];

var sl = {
  app: angular.module('sl', dependencies),
  controllers: angular.module('sl.controllers', []),
  directives: angular.module('sl.directives', []),
  services: angular.module('sl.services', [])
};
