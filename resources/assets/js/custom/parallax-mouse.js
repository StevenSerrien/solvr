$(document).ready(function() {
  var movementStrength = 25;
  var height = movementStrength / $(window).height();
  var width = movementStrength / $(window).width();
  $("#p-lax").mousemove(function(e){
    var pageX = e.pageX - ($(window).width() / 2);
    var pageY = e.pageY - ($(window).height() / 2);
    var newvalueX = width * pageX * - 1;
    var newvalueY = height * pageY * - 1;

    var newvalueQ = height * pageX * - 1.4;
    var newvalueZ = height * pageY * - 1.4;

    $('#p-lax').css('transform', 'translate(' + newvalueX + 'px,' + newvalueY + 'px)');

    $('#p-lax .p-lax-inner').css('transform', 'translate(' + newvalueQ + 'px,' + newvalueZ + 'px)');
  });
  $("#p-lax").mouseleave(function(){
    // $('#p-lax').css('transform', 'translate(0px,0px)');
  });


  jQuery.fn.center = function(parent) {
    if (parent) {
      parent = this.parent();
    } else {
      parent = window;
    }
    this.css({
      "position": "absolute",
      "top": ((($(parent).height() - this.outerHeight()) / 2) + $(parent).scrollTop() + "px")
    });
    return this;
  }

  $("#p-lax .p-lax-inner").center(true);

});
