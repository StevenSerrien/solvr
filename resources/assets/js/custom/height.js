$(function(){
    var topBarHeight = $('.top-bar').outerHeight(true);
    $('.bg').height( $(this).height() - $('.top-bar').outerHeight(true));

    $('.bg').css('top', topBarHeight + 'px');

});
