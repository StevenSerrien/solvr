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

sl.directives.directive('ngjsColorPicker', function() {
       var template =
           '<ul ng-style="ulCss"> \
               <li ng-repeat="color in colors | limitTo: options.total" \
                   ng-class="{ \
                   selectedColor: (color===selectedColor), \
                   hRDF: $first&&hzRound, \
                   hRDL: $last&&hzRound, \
                   vRDF: $first&&vertRound, \
                   vRDL: $last&&vertRound, \
                   tlRound: $first&&columnRound, \
                   trRound: $index==(options.columns-1)&&columnRound, \
                   brRound: $last&&columnRound, \
                   blRound: $index==(colors.length-options.columns)&&columnRound \
                   }" \
                   ng-click="pick(color)" \
                   ng-attr-style="background-color:{{color}};" \
                   ng-style="getCss(color)"> \
                   </li>\
               </ul>';

       var styling = [
           {
               selector: 'ul',
               rules: [
                   'padding: 0',
                   'outline: none',
                   'list-style-type: none'
               ]
           },
           {
               selector: 'li',
               rules: [
                   'padding: 0',
                   'margin: 0',
                   'box-sizing: border-box',
                   'outline: none'
               ]
           },
           {
               selector: 'li.selectedColor',
               rules: [
                   'border: 1px solid #333'
               ]
           },
           {
               selector: 'li.hRDF',
               rules: [
                   'border-radius: 5px 0 0 5px'
               ]
           },
           {
               selector: 'li.hRDL',
               rules: [
                   'border-radius: 0 5px 5px 0'
               ]
           },
           {
               selector: 'li.vRDF',
               rules: [
                   'border-radius: 5px 5px 0 0'
               ]
           },
           {
               selector: 'li.vRDL',
               rules: [
                   'border-radius: 0 0 5px 5px'
               ]
           },
           {
               selector: 'li.tlRound',
               rules: [
                   'border-radius: 5px 0 0 0'
               ]
           },
           {
               selector: 'li.trRound',
               rules: [
                   'border-radius: 0 5px 0 0;'
               ]
           },
           {
               selector: 'li.brRound',
               rules: [
                   'border-radius: 0 0 5px 0;'
               ]
           },
           {
               selector: 'li.blRound',
               rules: [
                   'border-radius: 0 0 0 5px;'
               ]
           }
       ];

       var defaultColors =  [
           '#7bd148',
           '#5484ed',
           '#a4bdfc',
           '#46d6db',
           '#7ae7bf',
           '#51b749',
           '#fbd75b',
           '#ffb878',
           '#ff887c',
           '#dc2127',
           '#dbadff',
           '#e1e1e1'
       ];

       var defaultValues = {
           colors: defaultColors,
           options: {
               size: 20,
               columns: null,
               randomColors: null
           },
           gradient: null
       };

       var setInitValues = function(scope) {
           scope.colors = defaultColors;
           scope.options = scope.options || {};
           scope.options.size = scope.options.size || defaultValues.options.size;
           scope.options.columns = scope.options.columns || defaultValues.options.columns;
           scope.options.randomColors =
               scope.options.randomColors || defaultValues.options.randomColors;
           scope.options.total = scope.options.total || scope.colors.length;
           scope.options.horizontal =
               (scope.options.hasOwnProperty('horizontal') ? scope.options.horizontal : true);
           scope.options.roundCorners =
               (scope.options.hasOwnProperty('roundCorners') ?
                   scope.options.roundCorners : false);
           scope.gradient = scope.gradient || defaultValues.gradient;

           scope.ulCss = {};
           scope.css = {};
           scope.css.display = (scope.options.horizontal ? 'inline-block' : 'block');
           scope.css.width = scope.css.height = scope.options.size + 'px';
       };

       var setColors = function(scope) {
           if (!!scope.customColors) {
               scope.colors = scope.customColors;
           } else if (scope.options && !!scope.options.randomColors) {
               if (scope.options.randomColors > 0) {
                   scope.colors = [];
                   var randomColors = scope.options.randomColors;
                   while (randomColors !== 0) {
                       scope.colors.push(getRandomHexColor());
                       randomColors--;
                   }
               } else {
                   // TODO: Handle this
                   // Random colors array is empty
               }
           } else if (!!scope.gradient) {
               // If step === 0        => nothing will happen.
               // If step === 1        => it will add 3 shades to all
               //                         colors (2.55 shades per 1%, rounded)
               var validHex = formatToHex(scope.gradient.start);
               var isOkHex = /(^#[0-9A-F]{6}$)|(^#[0-9A-F]{3}$)/i.test(validHex);
               if (isOkHex) {
                   scope.colors = [];
                   var count =
                       (scope.gradient.hasOwnProperty('count') ? scope.gradient.count : 10);
                   var interval =
                       (scope.gradient.hasOwnProperty('step') ? scope.gradient.step : 1);
                   while (count !== 0) {
                       scope.colors.push(shadeColor(scope.colors.length === 0 ?
                           validHex : scope.colors[scope.colors.length - 1], interval));
                       interval+=scope.gradient.step;
                       count--;

                       // If black or white - stop generating more colors
                       if (scope.colors[scope.colors.length - 1].toLowerCase() === '#ffffff' ||
                           scope.colors[scope.colors.length - 1] === '#000000')
                           count = 0;
                   }
               } else {
                   // TODO: Handle this
                   // Hex is not valid
               }
           }
       };

       var setColumns = function(scope) {
           // Uneven amount of columns     => no round corners
           //                              => horizontal or vertical has no effect
           var indexOfPx = scope.css.width.indexOf('p');
           scope.ulCss.width = scope.options.columns *
               (parseInt(scope.css.width.substr(0, indexOfPx), 10)) + 'px';
           scope.ulCss.height =
               scope.options.size * (scope.colors.length / scope.options.columns) + 'px';
           scope.css.cssFloat = 'left';

           // Set rounded corners
           var isOkColumn = (scope.colors.length % scope.options.columns) === 0;
           scope.columnRound =
               (isOkColumn && scope.options.columns && scope.options.roundCorners);
       };

       var setRoundedCorners = function(scope) {
           scope.hzRound = scope.options.horizontal && scope.options.roundCorners &&
               !scope.options.columns;
           scope.vertRound = !scope.options.horizontal && scope.options.roundCorners &&
               !scope.options.columns;
       };

       var setInitialSelectedColor = function(scope) {
           scope.selectedColor = scope.selectedColor || scope.colors[0];
       };

       var getHtmlCssStyle = function(selector, rules) {
           var prefix = 'ngjs-color-picker';
           return prefix + ' ' + selector + ' {' + rules.join(';') + '}';
       };

       var applyCssToHtml = function() {
           var styles = styling.map(function(element) {
               return getHtmlCssStyle(element.selector, element.rules);
           });

           angular.element(document).find('head').prepend(
               '<style type="text/css">' + styles.join(' ') + '</style>');
       };

       /* Util functions */
       var getRandomHexColor = function() {
           return ('#' + (Math.random().toString(16) + '000000').slice(2, 8));
       };

       var formatToHex = function(hex) {
           var index = +(hex.charAt(0) === '#');
           return '#' + hex.substr(index).toLowerCase();
       };

       var shadeColor = function(color, percent) {
           var num = parseInt(color.slice(1), 16),
               amt = Math.round(2.55 * percent),
               R = (num >> 16) + amt,
               G = (num >> 8 & 0x00FF) + amt,
               B = (num & 0x0000FF) + amt;
           return '#' + (0x1000000 + (R<255?R<1?0:R:255)*0x10000 +
               (G<255?G<1?0:G:255)*0x100 + (B<255?B<1?0:B:255)).toString(16).slice(1);
       };

       return {
           scope: {
               selectedColor: '=?',
               customColors: '=?',
               options: '=?',
               gradient: '=?'
           },
           restrict: 'E',
           template: template,
           link: function(scope) { // element, attr

               setInitValues(scope);
               setColors(scope);
               setInitialSelectedColor(scope);
               setRoundedCorners(scope);
               applyCssToHtml();

               if (!!scope.options.columns) {
                   setColumns(scope);
               }

               scope.getCss = function(color) {
                   scope.css.background = color;
                   return scope.css;
               };

               scope.pick = function(color) {
                   scope.selectedColor = color;
               };

           }
       };

   });

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

sl.directives.directive('soDropdownAges', ['$timeout', function($timeout) {
    return {
        restrict: 'E',
        require: 'ngModel',
        replace: true,
        transclude: true,
        template: function (el, atts) {
            var itemName = 'dropdownItem';
            var valueField = itemName + '.' + (atts.valueField || 'id');
            var textField = itemName + '.' + (atts.textField || 'ageStart');
            var localityField = itemName + '.' + (atts.textField || 'ageEnd')
            return "<select class='ui search dropdown'>" +
                "<div ng-transclude></div>" +
                "   <option value='{{" + valueField + "}}' ng-repeat='" + itemName + " in " + atts.dropdownItems + " track by " + valueField + "'>" +
                "       {{" + textField + "}}" +
                "  tot " + "{{" + localityField + "}}" + " jaar"  +
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
                // console.log('set value', el, ngModel, ngModel.$viewValue);
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

sl.directives.directive('soDropdownNormal', ['$timeout', function($timeout) {
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
                // console.log('set value', el, ngModel, ngModel.$viewValue);
                $timeout(function () {
                    $(el).dropdown('set value', ngModel.$viewValue);
                });
                //$(el).dropdown('set value', ngModel.$viewValue);
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

sl.controllers.controller('ExercisePractitionerCtrl', ["$scope", "$rootScope", "$route", "$location", "service", "$window", function($scope, $rootScope, $route, $location, service, $window) {
  var self = this;
  var getSubCategoriesUrl = '/subcatorgies/get/with-id';
  var getAllColors = '/colors/get-all';

  var createExerciseUrl = '/logopedist/oefeningen/opstellen/opslaan';

  this.events = {
    init: function(category, ageRanges) {
      console.log(ageRanges);
      self.handlers.getSubCategories(category);
      self.handlers.getAllColors();
      self.state.ageRanges = ageRanges;
      self.handlers.addNewQuestion();
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
    },
    checkIfFirstStepsAreChosen: function() {
      console.log(self.state.datatosend);
    },
    addNewQuestion: function() {
      console.log('hallo');
      self.state.datatosend.questions.push('');
    },
    removeQuestion: function(index) {
      console.log(index);
      self.state.datatosend.questions.splice(index,1);
    },
    createExercise: function() {
      console.log(self.state.datatosend);
      service.post(createExerciseUrl, self.state.datatosend).then(function successCallback(response) {

        if (response.status == 'success') {
          console.log('leven over');
          window.location.href = '/logopedist/oefeningen';
        }
      }, function errorCallback(response) {

      }
      );
    },
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
      selectedColor: '',
      exercise: {
      },
      questions: [],
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

}]);

sl.controllers.controller('practiceContactController', ["$scope", "$log", "$modal", "$rootScope", "$location", "service", "$window", function($scope, $log, $modal, $rootScope, $location, service, $window) {
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
        console.log(self.state.practiceFromDB);
        angular.forEach(self.state.practiceFromDB, function(value, index){

          self.state.practiceFromDB[index].coords = {};
          self.state.practiceFromDB[index].coords.latitude = self.state.practiceFromDB[index].lat;
          self.state.practiceFromDB[index].coords.longitude = self.state.practiceFromDB[index].lng;

          self.state.practiceFromDB[index].latitude = self.state.practiceFromDB[index].lat;
          self.state.practiceFromDB[index].longitude = self.state.practiceFromDB[index].lng;

          self.state.practiceFromDB[index].show = false;

          self.state.practiceFromDB[index].templateUrl = 'markerWindow.html';

          // Push into readable array for Google Angular maps
          self.state.practices.push(self.state.practiceFromDB[index]);

          if (index == 0) {
            self.state.map.center = self.state.practiceFromDB[index].coords;
          }

        });

        // console.log(self.state.practices);

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
          self.state.practicesFromDBWS = response;
          console.log(self.state.practicesFromDBWS);
          self.state.practices.length = 0;
          angular.forEach(self.state.practicesFromDBWS, function(value, index){
            console.log('joski');

            if (self.state.practicesFromDBWS[index].distance) {
              self.state.practicesFromDBWS[index].distance = Math.round(self.state.practicesFromDBWS[index].distance / 100) / 10;
            }

            self.state.practicesFromDBWS[index].templateUrl = 'markerWindow.html';

            self.state.practices.push(self.state.practicesFromDBWS[index]);

            if (index == 0) {
              self.state.map.center = self.state.practicesFromDBWS[index].coords;
            }

          });
          // console.log(self.state.practices);

      }, function errorCallBack(response) {

      })
    },
    getAllSpecialities: function() {
      service.get(getAllSpecialities).then(function successCallback(response) {
        // console.log(response);
        self.state.specialities = response;
        // console.log(self.state.specialities);
      }, function errorCallback(response) {

      });
    },
  };

  this.markerhandlers = {
    onClick: function(marker, eventName, model) {
    
      model.show = !model.show;

      console.log(model);
      console.log('ons mdoemoe');
    },
    contact: function() {
      console.log(self.state.practices);
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
    practicesFromDBWS: {},
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

sl.controllers.controller('UserDashboardCtrl', ["$scope", "$rootScope", "$location", "service", "$window", function($scope, $rootScope, $location, service, $window) {
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
