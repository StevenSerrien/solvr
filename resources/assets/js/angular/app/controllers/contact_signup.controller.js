sl.controllers.controller('ContactSignupCtrl', function($scope, $rootScope, $location, service, $window) {
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
      console.log(self.state.practicesFromDB);
      service.get(allPracticesUrl).then(function successCallback(response) {
        self.state.practicesFromDB = response;

        console.log(self.state.practicesFromDB);
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
});
