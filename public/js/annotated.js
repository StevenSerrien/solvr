var dependencies = [
  'sl.services',
  'sl.directives',
  'sl.controllers',

  'ngAnimate',
  'ngRoute',
  'ngSanitize',
  'angular.vertilize',
  'ngMask',
  'validation.match'
];

var sl = {
  app: angular.module('sl', dependencies),
  controllers: angular.module('sl.controllers', []),
  directives: angular.module('sl.directives', []),
  services: angular.module('sl.services', [])
};

sl.app.config(["$locationProvider", "$interpolateProvider", function($locationProvider, $interpolateProvider) {
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

sl.directives.directive('slAutofill', function(){
  return function(scope, elem, attrs) {

      // Fix autofill issues where Angular doesn't know about autofilled inputs
      if(attrs.ngSubmit) {
        setTimeout(function() {
          elem.unbind('submit').submit(function(e) {
            e.preventDefault();
            elem.find('input, textarea, select').trigger('input').trigger('change').trigger('keydown');
            scope.$apply();
          });
        }, 0);
      }
    };
})

sl.directives.directive('slPwCheck', function(){
  return {
      require: 'ngModel',
      link: function (scope, elem, attrs, ctrl) {
        var firstPassword = '#' + attrs.pwCheck;
        elem.add(firstPassword).on('keyup', function () {
          scope.$apply(function () {
            var v = elem.val()===$(firstPassword).val();
            ctrl.$setValidity('pwmatch', v);
          });
        });
      }
    }
});

sl.services.service('service', ["$http", "$q", function($http, $q){
  this.fetch = function(method, url, data) {
    var _promise = $q.defer();
    $http({
      method: method,
      url: url,
      data: data,
      headers: {
        'Content-Type': 'application/json'
      }
    }).then(function(response) {
      _promise.resolve(response.data);
    }, function(error) {
      _promise.reject(error);
    });
    return _promise.promise;
  };

  this.afetch = function(method, url, data) {
    return $http({
      method: method,
      url: url,
      data: data,
      headers: {
        'Content-Type': 'application/json'
      }
    }).success(function(response){
      return response;
    }).error(function(response){
      return response.data;
    });
};

  this.get = function(url) {
    var data = {};
    return this.fetch('GET', url, data);
  };

  this.post = function(url, data) {
    return this.fetch('POST', url, data);
  };
  //
  // this.apost = function(url, data) {
  //   return this.afetch('POST', url, data);
  // };
}]);

sl.controllers.controller('ContactSignupCtrl', ["$scope", "$rootScope", "$location", "service", "$window", function($scope, $rootScope, $location, service, $window) {
  var self = this;

  var savePractitioner = '/logopedist/nieuw';
  var checkIfPractitionerExistsUrl = '/logopedist/checkIfExists';

  this.events = {

    changeTemplate: function(index) {
      self.state.currentTemplate = self.state.templates[index];

    },

    updateUserData: function(index) {


      // User info
      if (index == 0) {
        self.state.loading = true;
        self.handlers.checkExistingUserRecord();
      }
      // Choice of new practice or existing
      if (index == 1) {
        self.events.changeTemplate(index + 1);
      }
      // Registratiestap
      if (index == 2) {
        self.handlers.postUserDataToServer();
      }


    },
  };

  this.handlers = {
    fillTemplates: function() {
      self.state.templates = [
        { name: 'state-1.html', url: 'assets/templates/contact/state-1.html', index: 0, stateClass: 'state-0'},
        { name: 'state-2.html', url: 'assets/templates/contact/state-2.html', index: 1, stateClass: 'state-1'},
        { name: 'state-3.html', url: 'assets/templates/contact/state-3.html', index: 2 },
        { name: 'state-4.html', url: 'assets/templates/contact/state-4.html', index: 3 },
      ]
      self.state.currentTemplate = self.state.templates[0];
    },
    postUserDataToServer: function() {
      service.post(savePractitioner, self.state.datatosend);
      console.log(self.state.datatosend);
    },
    checkExistingUserRecord: function() {
      service.post(checkIfPractitionerExistsUrl, self.state.datatosend.user).then(function successCallback(response) {
        console.log(response);
        self.state.loading = false;
        self.state.response = response;
        self.events.changeTemplate(self.state.currentTemplate.index + 1);

      }, function errorCallback(response) {
        console.log(response.data);
        self.state.loading = false;
        self.state.response = response.data;
      }

      );
    },
  };

  // listeners
  $rootScope.$on('$locationChangeSuccess', function() {
    self.handlers.fillTemplates();
  });

  this.state = {
    datatosend: {
      practice: {

      },
      user: {

      },
    },
    loading: false,
    response: {},

    globalForm: {},
    animationClass: 'in-and-out',

    templates: [],
    currentTemplate: ''
  };

  var placeSearch, autocomplete;
  var componentForm = {
    street_number: 'short_name',
    route: 'long_name',
    locality: 'long_name',
    postal_code: 'short_name'
  };


  this.googleHandlers = {
    initAutocomplete: function() {
      // Create the autocomplete object, restricting the search to geographical
      // location types.
      autocomplete = new google.maps.places.Autocomplete(
          /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
          {
            types: ['geocode'],
            componentRestrictions: {country: 'be'}//Belgium only
        });

      // When the user selects an address from the dropdown, populate the address
      // fields in the form.
      google.maps.event.addListener(autocomplete, 'place_changed', function(){
        var place = autocomplete.getPlace();




        // self.state.datatosend.practice.streetname.$apply();
        // $scope.$apply( function() {
        // Location info
          for (var i = 0; i < place.address_components.length; i++) {
            var addressType = place.address_components[i].types[0];
            if (componentForm[addressType]) {
              var val = place.address_components[i][componentForm[addressType]];
              self.state.datatosend.practice[addressType] = val;
            }
          };
          // Lat and long
          self.state.datatosend.practice.lat = place.geometry.location.lat();
          self.state.datatosend.practice.lng = place.geometry.location.lng();

          $scope.$digest();
      });
    },
  }
}]);
