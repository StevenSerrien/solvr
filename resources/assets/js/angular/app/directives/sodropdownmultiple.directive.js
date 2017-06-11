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
