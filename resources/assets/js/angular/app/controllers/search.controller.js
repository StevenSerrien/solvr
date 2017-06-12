sl.controllers.controller('SearchCtrl', function($scope, $rootScope, $location, service, $window) {
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
  });
