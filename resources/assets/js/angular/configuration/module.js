var dependencies = [
  'sl.services',
  'sl.directives',
  'sl.controllers',

  'ngAnimate',
  'ngRoute',
  'ngSanitize',
];

var sl = {
  app: angular.module('sl', dependencies),
  controllers: angular.module('sl.controllers', []),
  directives: angular.module('sl.directives', []),
  services: angular.module('sl.services', [])
};
