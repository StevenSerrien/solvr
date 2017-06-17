sl.controllers.controller('UserDashboardCtrl', function($scope, $rootScope, $location, service, $window) {
  var self = this;

  var allColorschemesUrl = '/user/colorschemes/all';
  var getUserColorschemeUrl = '/user/colorschemes/current';
  var changeColorscheme = '/user/colorschemes/change';
  var testUrl = "/test/test/test";
  var checkCodeUrl = '/exercise/code/check';

  var exerciseUrl = '/dashboard/oefening-maken/{code}/{slug?}';


  this.events = {
    init: function() {
      self.handlers.getAllColorschemes();
      self.handlers.getCurrentColorscheme();
    },
  };

  this.handlers = {
    getAllColorschemes: function() {
      service.get(allColorschemesUrl).then(function successCallback(response) {
        angular.forEach(response, function(value, index){
          self.state.colorschemes.push(response[index].hex);

        });
      }, function errorCallback(response) {

      });
    },
    changeColorscheme: function() {
      self.state.colortosend.length = 0;
      self.state.colortosend.push(self.state.selectedColor);
      console.log(self.state.colortosend);

      service.post(changeColorscheme, self.state.colortosend).then(function successCallback(response) {
        console.log(response);

      }, function errorCallBack(response) {

      })
    },
    getCurrentColorscheme: function() {
      service.get(getUserColorschemeUrl).then(function successCallback(response) {
        // console.log(response);
        self.state.selectedColor = response.colorscheme.hex;
      }, function errorCallback(response) {

      });
    },
    checkIfCodeExists: function() {
      service.post(checkCodeUrl, self.state.code).then(function successCallback(response) {
        self.state.coderesponse = response;
        // console.log(self.state.coderesponse.status);
        if (self.state.coderesponse.status = 'success') {
          $window.location.href = '/dashboard/oefening-maken/' + response.code;
        }
        // self.state.selectedColor = response.colorscheme.hex;
      }, function errorCallback(response) {
        self.state.coderesponse = response.data;
        console.log(self.state.coderesponse);
      });
    },
  };

  $scope.$watchCollection('selectedColor', function() {
    console.log('hallooo');

  });



  // listeners
  $rootScope.$on('$locationChangeSuccess', function() {

  });

  this.state = {
    userRegister: {},
    selectedColor: {},
    colorschemes: [],
    colortosend: [],
    code: [],
    ngjsColorPicker: {
      options: {
        size: 30,
        roundCorners: true
      }
    },
  };

});
