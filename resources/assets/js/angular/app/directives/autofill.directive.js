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
