sl.controllers.controller('practitionerDashboardController', function($scope, $log, $modal, $rootScope, $location, service, $window) {
  var self = this;
  var testRoute = '/logopedist/test';
  var getAllPractitioners = '/practice/getallpractitioners';

  this.events = {

  };

  this.handlers = {
    initPracticeView: function() {
      self.handlers.getAllPractitionersByPractice();
    },

    test: function() {
      $('.p-profile').initial();
    },
    modal: function(practitioner) {
      self.state.selectedPractitioner = practitioner;
      $scope.$digest;
    },

    getAllPractitionersByPractice: function() {
      service.get(getAllPractitioners).then(function successCallback(response) {
        // console.log(response);
        self.state.practice = response[0];

        console.log(self.state.practice);

        angular.forEach(response[0].practitioners, function(value, index){

          if (response[0].practitioners[index].isConfirmed == 0) {
            self.state.unconfirmedPractitioners.push(response[0].practitioners[index]);
          }
          else {
            self.state.linkedPractitioners.push(response[0].practitioners[index]);
          }

          // console.log(response[0].practitioners[index]);
        });
        console.log(self.state.linkedPractitioners);
        console.log(self.state.unconfirmedPractitioners);


      }, function errorCallback(response) {

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
        templateUrl: 'myModalContent.html',
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
            console.log('correct gesloten' + practitioner.firstname);
            $log.info(practitioner.firstname);
        }, function() {
            $log.info('Modal dismissed at: ' + new Date());
      });
    }
  }



  // listeners
  $rootScope.$on('$locationChangeSuccess', function() {

  });

  this.state = {
    practice: {

    },
    linkedPractitioners: [

    ],
    unconfirmedPractitioners: [

    ],
    selectedPractitioner: {

    },

  };

});
