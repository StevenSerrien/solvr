$(document).ready(function() {
var movementStrength = 25;
var height = movementStrength / $(window).height();
var width = movementStrength / $(window).width();
$("#p-lax").mousemove(function(e){
          var pageX = e.pageX - ($(window).width() / 2);
          var pageY = e.pageY - ($(window).height() / 2);
          var newvalueX = width * pageX * -1;
          var newvalueY = height * pageY * -1;
          $('#p-lax').css('transform', 'translate(' + newvalueX + 'px,' + newvalueY + 'px)');
});
$("#p-lax").mouseleave(function(){
  // $('#p-lax').css('transform', 'translate(0px,0px)');
})
});
