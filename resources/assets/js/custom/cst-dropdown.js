$(function(){
  $.fn.dropdown.settings.message.noResults = 'Niets gevonden met deze naam. Ga terug en registreer je praktijk.';
  $.fn.dropdown.settings.message.count = '{count} geselecteerd.';
  $('.cst-dropdown.single')
  .dropdown({
    allowAdditions: true
  });
  console.log('bennedr');


});
