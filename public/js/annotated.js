var dependencies = [
  'sl.services',
  'sl.directives',
  'sl.controllers',

  'angular-loading-bar',
  'ngAnimate',
  'uiGmapgoogle-maps',
  'nemLogging',
  'ngRoute',
  'ngSanitize',
  'angular.vertilize',
  'ngMask',
  'validation.match',
  'ngLetterAvatar',
  'mm.foundation',
  'ngTouch',

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

sl.directives.directive('profileInitial', ['$timeout', function($timeout) {
    return {
        restrict: 'A',
        replace: true,
        template: function (el, atts) {
            var dataName =  atts.dataName;

            return
                "<img data-name'" + atts.dataName + "' class='p-profile' />";
        },
    };
}]);

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

sl.directives.directive('soDropdown', ['$timeout', function($timeout) {
    return {
        restrict: 'E',
        require: 'ngModel',
        replace: true,
        transclude: true,
        template: function (el, atts) {
            var itemName = 'dropdownItem';
            var valueField = itemName + '.' + (atts.valueField || 'id');
            var textField = itemName + '.' + (atts.textField || 'name');
            var localityField = itemName + '.' + (atts.textField || 'locality')
            return "<select class='ui search dropdown'>" +
                "<div ng-transclude></div>" +
                "   <option value='{{" + valueField + "}}' ng-repeat='" + itemName + " in " + atts.dropdownItems + " track by " + valueField + "'>" +
                "       {{" + textField + "}}" +
                "  ( " + "{{" + localityField + "}}" + " )"  +
                "   </option>" +
                "</select>";
        },
        link: function (scope, el, atts, ngModel) {
            $(el).dropdown({
                onChange: function (value, text, choice) {
                    scope.$apply(function () {
                        ngModel.$setViewValue(value);
                        
                    });
                },
                placeholder: atts.placeholder,
            });
            ngModel.$render = function () {
                console.log('set value', el, ngModel, ngModel.$viewValue);
                $timeout(function () {
                    $(el).dropdown('set value', ngModel.$viewValue);
                });
                //$(el).dropdown('set value', ngModel.$viewValue);
            };
        }
    };
}]);

sl.directives.directive('soDropdownMultiple', ['$timeout', function($timeout) {
    return {
        restrict: 'E',
        require: 'ngModel',
        replace: true,
        transclude: true,
        template: function (el, atts) {
            var itemName = 'dropdownItem';
            var valueField = itemName + '.' + (atts.valueField || 'id');
            var textField = itemName + '.' + (atts.textField || 'name');
            var localityField = itemName + '.' + (atts.textField || 'locality')
            return "<select class='ui fluid normal dropdown selection multiple' multiple=''>" +
                "<div ng-transclude></div>" +
                "   <option value='{{" + valueField + "}}' ng-repeat='" + itemName + " in " + atts.dropdownItems + " track by " + valueField + "'>" +
                "       {{" + textField + "}}" +
                "   </option>" +
                "</select>";
        },
        link: function (scope, el, atts, ngModel) {
            $(el).dropdown({
                // onChange: function (value, text, choice) {
                //     scope.$apply(function () {
                //         ngModel.$setViewValue(value);
                //
                //     });
                // },
                placeholder: atts.placeholder,
            });
            ngModel.$render = function () {
                console.log('set value', el, ngModel, ngModel.$viewValue);
                $timeout(function () {
                    $(el).dropdown('set value', ngModel.$viewValue);
                });
                // $(el).dropdown('set value', ngModel.$viewValue);
            };
        }
    };
}]);

sl.directives.directive('soDropdownMultipleNolabel', ['$timeout', function($timeout) {
    return {
        restrict: 'E',
        require: 'ngModel',
        replace: true,
        transclude: true,
        template: function (el, atts) {
            var itemName = 'dropdownItem';
            var valueField = itemName + '.' + (atts.valueField || 'id');
            var textField = itemName + '.' + (atts.textField || 'name');
            var localityField = itemName + '.' + (atts.textField || 'locality')
            return "<select class='ui fluid normal dropdown selection multiple' multiple=''>" +
                "<div ng-transclude></div>" +
                "   <option value='{{" + valueField + "}}' ng-repeat='" + itemName + " in " + atts.dropdownItems + " track by " + valueField + "'>" +
                "       {{" + textField + "}}" +
                "   </option>" +
                "</select>";
        },
        link: function (scope, el, atts, ngModel) {
            $(el).dropdown({
                // onChange: function (value, text, choice) {
                //     scope.$apply(function () {
                //         ngModel.$setViewValue(value);
                //
                //     });cst-dropdown ui fluid normal dropdown selection multiple
                // },
                placeholder: atts.placeholder,
                useLabels: false,
            });
            ngModel.$render = function () {
                console.log('set value', el, ngModel, ngModel.$viewValue);
                $timeout(function () {
                    $(el).dropdown('set value', ngModel.$viewValue);
                });
                // $(el).dropdown('set value', ngModel.$viewValue);
            };
        }
    };
}]);

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
  var checkIfPracticeExistsUrl = '/logopedist/praktijk/checkIfExists';
  var allPracticesUrl = '/practices/get/all';
  var getPracticeById = '/practices/get/with-id';

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
        if (self.user.practiceStatus == 'new') {
          self.state.loading = true;
          self.state.datatosend.existingPractice = '';
          self.handlers.checkExistingPracticeRecord();

        }
        else if (self.user.practiceStatus == 'existing') {
          self.state.registerloading = true;
          self.handlers.postUserDataToServer();
        }

      }


    },
    fillDropdownExistingPractices: function() {
      self.handlers.getAllExistingPractices();
    }
  };

  this.handlers = {
    fillTemplates: function() {
      self.state.templates = [
        { name: 'state-1.html', url: 'assets/templates/contact/state-1.html', index: 0, stateClass: 'state-0'},
        { name: 'state-2.html', url: 'assets/templates/contact/state-2.html', index: 1, stateClass: 'state-1'},
        { name: 'state-3.html', url: 'assets/templates/contact/state-3.html', index: 2, stateClass: 'state-2'},
        { name: 'state-4.html', url: 'assets/templates/contact/state-4.html', index: 3, stateClass: 'state-3'},
      ]
      self.state.currentTemplate = self.state.templates[0];
    },
    clearCurrentStorage: function() {
      self.state.datatosend = '';
      self.state.response = '';
    },
    postUserDataToServer: function() {
      self.state.registerloading = false;
      console.log(self.state.datatosend);
      service.post(savePractitioner, self.state.datatosend).then(function successCallback(response) {
        self.state.registerloading = false;
        self.state.loading = false;
        self.state.response = response;

        if (self.state.response.status == 'success') {

          self.handlers.clearCurrentStorage();
          self.events.changeTemplate(self.state.currentTemplate.index + 1);
        }


      }, function errorCallback(response) {
        self.state.registerloading = false;
        self.state.loading = false;
        self.state.response = response.data;
      }
      );

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
    checkExistingPracticeRecord: function() {
      service.post(checkIfPracticeExistsUrl, self.state.datatosend.practice).then(function successCallback(response) {
        self.state.loading = false;
        self.state.response = response;

        if (self.state.response.status == 'success') {
          // Send all data to register Practitioner and practice
          self.state.registerloading = true;
          self.handlers.postUserDataToServer();
        }

      }, function errorCallback(response) {
        console.log(response.data);
        self.state.loading = false;
        self.state.response = response.data;
      }
    );
    },
    getAllExistingPractices: function() {

      service.get(allPracticesUrl).then(function successCallback(response) {
        self.state.practicesFromDB = response;
        // console.log("alles bestaand");
        // console.log(response);

        // $scope.$digest();
      }, function errorCallback(response) {

      });
    },
    getPracticeById: function() {

      service.post(getPracticeById, self.state.selectedPractice).then(function successCallback(response) {
        if (response.length > 0) {
          console.log(response);
          self.state.datatosend.existingPractice = response[0];
        }
        // $scope.$digest();
      }, function errorCallback(response) {

      });
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
    practicesFromDB:  [],
    selectedPractice: {
      index: ''
    },
    // selectedId = 2,
    registerloading: false,
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

sl.controllers.controller('practitionerDashboardController', ["$scope", "$log", "$modal", "$rootScope", "$location", "service", "$window", function($scope, $log, $modal, $rootScope, $location, service, $window) {
  var self = this;
  var testRoute = '/logopedist/test';
  var getAllPractitioners = '/practice/getallpractitioners';
  var acceptPractitionerUrl = '/practitioner/acceptnew';
  var denyPractitionerUrl = '/practitioner/denynew';
  var getAllSpecialities = '/specialities/getall';
  var getAllSpecialitiesForPractice = '/practice/getcurrentspecialities';
  var updateSpecialitiesUrl = '/practice/updatespecialities';

  this.events = {

  };

  this.handlers = {
    initPracticeView: function() {
      self.handlers.getAllPractitionersByPractice();
    },

    test: function() {
      $('.p-profile').initial();
    },

    init: function(practitioner) {
      self.handlers.getAllSpecialities();

    },
    refreshData: function() {
      self.state.linkedPractitioners.length = 0;
      self.state.unconfirmedPractitioners.length = 0;
      self.handlers.getAllPractitionersByPractice();
    },
    getAllSpecialities: function() {
      service.get(getAllSpecialities).then(function successCallback(response) {
        // console.log(response);
        self.state.specialities = response;
      }, function errorCallback(response) {

      });
    },

    getAllPractitionersByPractice: function() {
      service.get(getAllPractitioners).then(function successCallback(response) {
        // console.log(response);
        self.state.practice = response[0];
        console.log(self.state.practice);

        // console.log(self.state.practice);
        self.handlers.getSpecialitiesOfPractice();
        angular.forEach(response[0].practitioners, function(value, index){

          if (response[0].practitioners[index].isConfirmed == 0) {
            self.state.unconfirmedPractitioners.push(response[0].practitioners[index]);
          }
          else {
            self.state.linkedPractitioners.push(response[0].practitioners[index]);
          }

          // console.log(response[0].practitioners[index]);
        });
        // console.log(self.state.linkedPractitioners);
        // console.log(self.state.unconfirmedPractitioners);


      }, function errorCallback(response) {

      });
    },
    acceptPractitioner: function(practitioner) {
      service.post(acceptPractitionerUrl, practitioner).then(function successCallback(response) {
        console.log(response);
        self.handlers.refreshData();
      }, function errorCallBack(response) {

      })
    },
    denyPractitioner: function(practitioner) {
      service.post(denyPractitionerUrl, practitioner).then(function successCallback(response) {
        console.log(response);
        self.handlers.refreshData();
      }, function errorCallBack(response) {

      });
    },
    updateSpecialities: function() {
      service.post(updateSpecialitiesUrl, self.state.selectedSpecialities).then(function successCallback(response) {
        // console.log(response);
        console.log(self.state.selectedSpecialities);
        // self.handlers.refreshData();
      }, function errorCallBack(response) {

      });
      // console.log(self.state.selectedSpecialities);
    },
    getSpecialitiesOfPractice: function() {
      service.post(getAllSpecialitiesForPractice, self.state.practice).then(function successCallback(response) {
        // console.log('hallo');
        // console.log(response);
        angular.forEach(response, function(value, index){

          self.state.selectedSpecialities.push(response[index].id);
          // if (response[0].practitioners[index].isConfirmed == 0) {
          //   self.state.unconfirmedPractitioners.push(response[0].practitioners[index]);
          // }
          // else {
          //   self.state.linkedPractitioners.push(response[0].practitioners[index]);
          // }

          // console.log(response[0].practitioners[index]);
        });
        console.log('hier is em dan');
        console.log(self.state.selectedSpecialities);

        // self.handlers.refreshData();
      }, function errorCallBack(response) {

      });
    }
    // submit: function() {
    //   service.post(testRoute, self.state.selectedPractice).then(function successCallback(response) {
    //
    //     // $scope.$digest();
    //   }, function errorCallback(response) {
    //
    //   });
    // },
  };

  this.modalHandlers = {
    acceptPractitioner: function(practitioner, size, backdrop, itemCount, closeOnClick) {
      self.state.selectedPractitioner = practitioner;
      // console.log("oerezoddddon");
      // console.log(self.state.selectedPractitioner);
      // console.log(practitioner);
      var params = {
        templateUrl: 'acceptPractitioner.html',
        resolve: {
          practitioner: function() {
            return self.state.selectedPractitioner;
          },
        },

        controller: function($scope, $modalInstance, practitioner) {
          var modal = this;
          $scope.practitioner = practitioner;



          $scope.reposition = function() {
            $modalInstance.reposition();
          };

          $scope.ok = function() {
            $modalInstance.close($scope.practitioner);
          };

          $scope.cancel = function() {
            $modalInstance.dismiss('cancel');
          };

          $scope.openNested = function() {
            open();
          };
        }
      };

      if(angular.isDefined(closeOnClick)){
        params.closeOnClick = closeOnClick;
      }

      if(angular.isDefined(size)){
        params.size = size;
      }

      if(angular.isDefined(backdrop)){
        params.backdrop = backdrop;
      }

      var modalInstance = $modal.open(params);

      modalInstance.result.then(function(practitioner) {
            self.handlers.acceptPractitioner(practitioner);
            // console.log('correct gesloten' + practitioner.firstname);
            // $log.info(practitioner.firstname);
        }, function() {
            $log.info('Modal dismissed at: ' + new Date());
      });
    },
    denyPractitioner: function(practitioner, size, backdrop, itemCount, closeOnClick) {
      self.state.selectedPractitioner = practitioner;

      var params = {
        templateUrl: 'denyPractitioner.html',
        resolve: {
          practitioner: function() {
            return self.state.selectedPractitioner;
          },
        },
        controller: function($scope, $modalInstance, practitioner) {
          var modal = this;
          $scope.practitioner = practitioner;



          $scope.reposition = function() {
            $modalInstance.reposition();
          };

          $scope.ok = function() {
            $modalInstance.close($scope.practitioner);
          };

          $scope.cancel = function() {
            $modalInstance.dismiss('cancel');
          };

          $scope.openNested = function() {
            open();
          };
        }
      };

      var modalInstance = $modal.open(params);

      modalInstance.result.then(function(practitioner) {
            self.handlers.denyPractitioner(practitioner);
            // console.log('correct gesloten' + practitioner.firstname);
            // $log.info(practitioner.firstname);
        }, function() {
            $log.info('Modal dismissed at: ' + new Date());
      });
    },
  }



  // listeners
  $rootScope.$on('$locationChangeSuccess', function() {

  });

  self.handlers.init();


  this.state = {
    practice: {

    },
    linkedPractitioners: [

    ],
    unconfirmedPractitioners: [

    ],
    selectedPractitioner: {

    },
    specialities: [],
    selectedSpecialities: [],

  };

}]);

sl.controllers.controller('SearchCtrl', ["$scope", "$rootScope", "$location", "service", "$window", function($scope, $rootScope, $location, service, $window) {
  var self = this;

  var allPracticesUrl = '/practices/get/all';
  var getAllSpecialities = '/specialities/getall';
  var allPracticesWithSelectedpecialitiesUrl = '/practices/get/all-w-specialities';

  $scope.$watch(function() {

  }, function(nv, ov) {
    self.handlers.getAllExistingPractices();
  }, true);

  this.events = {
    init: function() {
      // self.handlers.getAllExistingPractices();
      self.handlers.getAllSpecialities();
    },
  };

  this.handlers = {
    getAllExistingPractices: function() {

      service.get(allPracticesUrl).then(function successCallback(response) {

        self.state.practiceFromDB = response;
        angular.forEach(self.state.practiceFromDB, function(value, index){
          self.state.practiceFromDB[index].coords = {};
          self.state.practiceFromDB[index].coords.latitude = self.state.practiceFromDB[index].lat;
          self.state.practiceFromDB[index].coords.longitude = self.state.practiceFromDB[index].lng;

          self.state.practiceFromDB[index].latitude = self.state.practiceFromDB[index].lat;
          self.state.practiceFromDB[index].longitude = self.state.practiceFromDB[index].lng;

          self.state.practiceFromDB[index].show = false;

          // Push into readable array for Google Angular maps
          self.state.practices.push(self.state.practiceFromDB[index]);

          if (index == 0) {
            self.state.map.center = self.state.practiceFromDB[index].coords;
          }
        });

        console.log(self.state.practices);

        // angular.forEach(self.state.practices, function(value, index){
        //
        //   self.state.practices[index].coords =  {};
        //
        //   self.state.practices[index].coords.latitude = self.state.practiceFromDB);
        //   self.state.practices[index].coords.longitude = parseInt(self.state.practices[index].lng);
        //   // console.log(self.state.practices[index]);
        //
        // });
        // self.state.map.center = self.state.practices[0].coords;
        // console.log(self.state.practices[index]);

      }, function errorCallback(response) {

      });
    },
    getAllPracticesBySpecialities: function() {
      service.post(allPracticesWithSelectedpecialitiesUrl, self.state.datatosend).then(function successCallback(response) {
        console.log(response);
      }, function errorCallBack(response) {

      })
    },
    getAllSpecialities: function() {
      service.get(getAllSpecialities).then(function successCallback(response) {
        // console.log(response);
        self.state.specialities = response;
        console.log(self.state.specialities);
      }, function errorCallback(response) {

      });
    },
  };

  this.markerhandlers = {
    onClick: function(marker, eventName, model) {
      console.log(model);
      model.show = !model.show;
    },
  };



  // listeners
  $rootScope.$on('$locationChangeSuccess', function() {

  });

  this.state = {
    map: {
      center: { latitude: '51', longitude: '4' },
      zoom: 10,
      events: {
        zoom_changed: function () {
          console.log('zoom_changed');

        }
      },
      options: {
        styles: [
          {
            "featureType": "administrative",
            "elementType": "labels.text.fill",
            "stylers": [
              {
                "color": "#6195a0"
              }
            ]
          },
          {
            "featureType": "landscape",
            "elementType": "all",
            "stylers": [
              {
                "color": "#f2f2f2"
              }
            ]
          },
          {
            "featureType": "landscape",
            "elementType": "geometry.fill",
            "stylers": [
              {
                "color": "#ffffff"
              }
            ]
          },
          {
            "featureType": "poi",
            "elementType": "all",
            "stylers": [
              {
                "visibility": "off"
              }
            ]
          },
          {
            "featureType": "poi.park",
            "elementType": "geometry.fill",
            "stylers": [
              {
                "color": "#e6f3d6"
              },
              {
                "visibility": "on"
              }
            ]
          },
          {
            "featureType": "road",
            "elementType": "all",
            "stylers": [
              {
                "saturation": -100
              },
              {
                "lightness": 45
              },
              {
                "visibility": "simplified"
              }
            ]
          },
          {
            "featureType": "road.highway",
            "elementType": "all",
            "stylers": [
              {
                "visibility": "simplified"
              }
            ]
          },
          {
            "featureType": "road.highway",
            "elementType": "geometry.fill",
            "stylers": [
              {
                "color": "#f4d2c5"
              },
              {
                "visibility": "simplified"
              }
            ]
          },
          {
            "featureType": "road.highway",
            "elementType": "labels.text",
            "stylers": [
              {
                "color": "#4e4e4e"
              }
            ]
          },
          {
            "featureType": "road.arterial",
            "elementType": "geometry.fill",
            "stylers": [
              {
                "color": "#f4f4f4"
              }
            ]
          },
          {
            "featureType": "road.arterial",
            "elementType": "labels.text.fill",
            "stylers": [
              {
                "color": "#787878"
              }
            ]
          },
          {
            "featureType": "road.arterial",
            "elementType": "labels.icon",
            "stylers": [
              {
                "visibility": "off"
              }
            ]
          },
          {
            "featureType": "transit",
            "elementType": "all",
            "stylers": [
              {
                "visibility": "off"
              }
            ]
          },
          {
            "featureType": "water",
            "elementType": "all",
            "stylers": [
              {
                "color": "#eaf6f8"
              },
              {
                "visibility": "on"
              }
            ]
          },
          {
            "featureType": "water",
            "elementType": "geometry.fill",
            "stylers": [
              {
                "color": "#eaf6f8"
              }
            ]
          }
        ]
      },
    },
    practices: [],
    practiceFromDB: {},
    marker: {
      options: {
        animation: google.maps.Animation.DROP,
        draggable: false,
        icon: {
          url: 'img/custom-marker-pre.png',
          scaledSize: new google.maps.Size(60, 60),
          anchor: new google.maps.Point(20,40),
        },
      },
    },
    specialities: [],
    selectedSpecialities: [],
    datatosend: {
      address: {},
      selectedSpecialities: [],
    }
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
        /** @type {!HTMLInputElement} */(document.getElementById('autocomplete2')),
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
              self.state.datatosend.address[addressType] = val;
            }
          };
          // Lat and long
          self.state.datatosend.address.lat = place.geometry.location.lat();
          self.state.datatosend.address.lng = place.geometry.location.lng();

          $scope.$digest();
        });
      },
    }
  }]);

sl.controllers.controller('TestCtrl', ["$scope", "$rootScope", "$location", "service", "$window", function($scope, $rootScope, $location, service, $window) {
  var self = this;


  this.events = {

  };

  this.handlers = {

  };



  // listeners
  $rootScope.$on('$locationChangeSuccess', function() {

  });

  this.state = {
    test: 'ja hallo dag',
  };

}]);

sl.controllers.controller('UserAuthCtrl', ["$scope", "$rootScope", "$location", "service", "$window", function($scope, $rootScope, $location, service, $window) {
  var self = this;


  this.events = {

  };

  this.handlers = {

  };



  // listeners
  $rootScope.$on('$locationChangeSuccess', function() {
    
  });

  this.state = {
    userRegister: {},
  };

}]);
