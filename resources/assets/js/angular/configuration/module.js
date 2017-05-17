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
