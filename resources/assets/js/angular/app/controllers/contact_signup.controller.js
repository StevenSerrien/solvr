sl.controllers.controller('ContactSignupCtrl', function($scope, $rootScope, $location, service, $window) {
  var self = this;



  this.events = {
    selectCarMake: function() {

    },
  };

  this.handlers = {
    fillTemplates: function() {
      self.state.templates = [
        { name: 'state-1.html', url: 'assets/templates/contact/state-1.html', index: 0 },
        { name: 'state-2.html', url: 'assets/templates/contact/state-2.html', index: 1 },
        { name: 'state-3.html', url: 'assets/templates/contact/state-3.html', index: 2 },
        { name: 'state-4.html', url: 'assets/templates/contact/state-4.html', index: 3 },
      ]
      self.state.currentTemplate = self.state.templates[0];
    }
  };

  // listeners
  $rootScope.$on('$locationChangeSuccess', function() {
    self.handlers.fillTemplates();
  });

  this.state = {
    user: [],
    practice: [],

    templates: [],
    currentTemplate: ''
  };
});
