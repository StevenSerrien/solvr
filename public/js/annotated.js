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

  // this.afetch = function(method, url, data) {
  //   var _promise = $q.defer();
  //   return $http({
  //     method: method,
  //     url: url,
  //     data: data,
  //     headers: {
  //       'Content-Type': 'application/json'
  //     }
  //   }).success(function(response){
  //
  //    return response;
  //
  //   }).error(function(err){
  //
  //     return err;
  //
  //   })
  // };

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
  var checkIfPractitionerExistsUrl = '/sql';

  this.events = {

    changeTemplate: function(index) {
      self.state.currentTemplate = self.state.templates[index];

    },

    updateUserData: function(index) {
      // self.events.changeTemplate(index + 1);

      // User info
      if (index == 0) {
        self.state.loading = true;
        self.handlers.checkExistingUserRecord();
        if (self.state.response == 'success') {
          console.log('yolo');
        }
        else {

        }

      }
      // Registratiestap
      if (index == 2) {
        // self.handlers.p
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
      service.post(newPractitionerUrl, self.state.datatosend);
    },
    checkExistingUserRecord: function() {
      service.post(checkIfPractitionerExistsUrl, self.state.datatosend.user).then(function successCallback(response) {
        console.log(response);
        self.state.loading = false;
        self.state.response = response;
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

        // });


        // for (var component in componentForm) {
        //   document.getElementById(component).value = '';
        //   document.getElementById(component).disabled = false;
        // }
        //
        // // Get each component of the address from the place details
        // // and fill the corresponding field on the form.
        // for (var i = 0; i < place.address_components.length; i++) {
        //   var addressType = place.address_components[i].types[0];
        //   if (componentForm[addressType]) {
        //     var val = place.address_components[i][componentForm[addressType]];
        //     document.getElementById(addressType).value = val;
        //   }
        //
        // }

      });
      // autocomplete.addListener('place_changed', function() {
      //   self.googleHandlers.fillInAdress();
      // });
    },

    // fillInAdress: function() {
    //   if (autocomplete.value == null || autocomplete.value == '') {
    //     console.log('leeg');
    //   }
    //   else {
    //     // Get the place details from the autocomplete object.
    //
    //     for (var component in componentForm) {
    //       document.getElementById(component).value = '';
    //       document.getElementById(component).disabled = false;
    //     }
    //
    //     // Get each component of the address from the place details
    //     // and fill the corresponding field on the form.
    //     for (var i = 0; i < place.address_components.length; i++) {
    //       var addressType = place.address_components[i].types[0];
    //       if (componentForm[addressType]) {
    //         var val = place.address_components[i][componentForm[addressType]];
    //         document.getElementById(addressType).value = val;
    //       }
    //     }
    //   }
    //
    //   Get the place details from the autocomplete object.
    //   var place = autocomplete.getPlace();
    //
    //   for (var component in componentForm) {
    //     document.getElementById(component).value = '';
    //     document.getElementById(component).disabled = false;
    //   }
    //
    //   // Get each component of the address from the place details
    //   // and fill the corresponding field on the form.
    //   for (var i = 0; i < place.address_components.length; i++) {
    //     var addressType = place.address_components[i].types[0];
    //     if (componentForm[addressType]) {
    //       var val = place.address_components[i][componentForm[addressType]];
    //       document.getElementById(addressType).value = val;
    //     }
    //   }
    // },

  }



  /* Google Places */
  // This example displays an address form, using the autocomplete feature
  // of the Google Places API to help users fill in the information.

  // This example requires the Places library. Include the libraries=places
  // parameter when you first load the API. For example:
  // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

  // var placeSearch, autocomplete;
  // var componentForm = {
  //   street_number: 'short_name',
  //   route: 'long_name',
  //   locality: 'long_name',
  //   postal_code: 'short_name'
  // };
  //
  // function initAutocomplete() {
  //   // Create the autocomplete object, restricting the search to geographical
  //   // location types.
  //   autocomplete = new google.maps.places.Autocomplete(
  //       /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
  //       {
  //         types: ['geocode'],
  //         componentRestrictions: {country: 'be'}//Belgium only
  //     });
  //
  //   // When the user selects an address from the dropdown, populate the address
  //   // fields in the form.
  //   autocomplete.addListener('place_changed', fillInAddress);
  // }
  //
  // function fillInAddress() {
  //   // Get the place details from the autocomplete object.
  //   var place = autocomplete.getPlace();
  //
  //   for (var component in componentForm) {
  //     document.getElementById(component).value = '';
  //     document.getElementById(component).disabled = false;
  //   }
  //
  //   // Get each component of the address from the place details
  //   // and fill the corresponding field on the form.
  //   for (var i = 0; i < place.address_components.length; i++) {
  //     var addressType = place.address_components[i].types[0];
  //     if (componentForm[addressType]) {
  //       var val = place.address_components[i][componentForm[addressType]];
  //       document.getElementById(addressType).value = val;
  //     }
  //   }
  // }
  //
  // // Bias the autocomplete object to the user's geographical location,
  // // as supplied by the browser's 'navigator.geolocation' object.
  // function geolocate() {
  //   if (navigator.geolocation) {
  //     navigator.geolocation.getCurrentPosition(function(position) {
  //       var geolocation = {
  //         lat: position.coords.latitude,
  //         lng: position.coords.longitude
  //       };
  //       var circle = new google.maps.Circle({
  //         center: geolocation,
  //         radius: position.coords.accuracy
  //       });
  //       autocomplete.setBounds(circle.getBounds());
  //     });
  //   }
  // }
}]);
