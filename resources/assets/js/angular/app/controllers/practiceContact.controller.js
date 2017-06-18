sl.controllers.controller('practiceContactController', function($scope, $log, $modal, $rootScope, $location, service, $window) {
  var self = this;
  var contactPracticeUrl = '/practice/contact';

  this.events = {
    init: function() {

    },
  };

  this.handlers = {
    sendContactForm: function(practice) {
      // Fill in practice in self.state

      self.state.loading = true;
      self.state.datatosend.practice = practice;
      service.post(contactPracticeUrl, self.state.datatosend).then(function successCallback(response) {

        self.state.loading = false;
        self.state.response = response;
        if (self.state.response.status == 'success') {
            self.state.datatosend.user = '';
            self.state.datatosend.practice = '';
        }

      }, function errorCallback(response) {

        self.state.loading = false;
        self.state.response = response.data;
      }
      );
    },
  };

  this.modalHandlers = {
  };



  // listeners
  $rootScope.$on('$locationChangeSuccess', function() {

  });

  self.events.init();


  this.state = {
    datatosend: {
      user: {

      },
      practice: {

      },
    },
    loading: false,
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

});
