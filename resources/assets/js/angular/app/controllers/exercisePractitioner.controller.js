sl.controllers.controller('ExercisePractitionerCtrl', function($scope, $rootScope, $location, service, $window) {
  var self = this;
  var getSubCategoriesUrl = '/subcatorgies/get/with-id';
  var getAllColors = '/colors/get-all';

  this.events = {
    init: function(category, ageRanges) {
      console.log(ageRanges);
      self.handlers.getSubCategories(category);
      self.handlers.getAllColors();
      self.state.ageRanges = ageRanges;
      
    },
  };

  this.handlers = {
    getSubCategories: function(category) {
      service.post(getSubCategoriesUrl, category).then(function successCallback(response) {

        self.state.subCategories = response;
        console.log(self.state.subCategories);
      }, function errorCallback(response) {

      }
      );
    },
    getAllColors: function() {
      service.get(getAllColors).then(function successCallback(response) {
        angular.forEach(response, function(value, index){
          self.state.colors.codes.push(response[index].code);
          // console.log(self.state.colors.codes);
        });
        // console.log(self.state.colors.codes);
      }, function errorCallback(response) {

      })
    }
  };



  // listeners
  $rootScope.$on('$locationChangeSuccess', function() {

  });

  this.state = {
    selectedCategory: '',
    subCategories: {},

    datatosend: {
      selectedSubCategoryID: '',
      selectedAgeRange: '',
    },
    datatosave: {
      selectedColor: '',
    },
    colors: {
      codes: [],
      names: {},
    },
    ageRanges: [],

    ngjsColorPicker: {
      options: {
        size: 30,
        roundCorners: true
      }
    },
  };

});
