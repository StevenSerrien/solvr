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
