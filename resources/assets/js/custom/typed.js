$(function(){
  if ($("#typed")) {
    console.log('typerkooe');
    $("#typed").css("display", "inline-block");

    Typed.new("#typed", {
      strings: ["Rekenen,", "Rekenen, taal", "Rekenen, taal en spelling"],
      typeSpeed: 50,
      stringsElement: null,
      // time before typing starts
      startDelay: 0,
      // backspacing speed
      backSpeed: 0,
      // shuffle the strings
      shuffle: false,
      // time before backspacing
      backDelay: 500,
      // Fade out instead of backspace (must use CSS class)
      fadeOut: false,
      fadeOutClass: 'typed-fade-out',
      fadeOutDelay: 500, // milliseconds
      // loop
      loop: false,
      // null = infinite
      loopCount: null,
      // show cursor
      showCursor: true,
      // character for cursor
      cursorChar: "|",
      // attribute to type (null == text)
      attr: null,
      // either html or text
      contentType: 'html',
      // call when done callback function
      callback: function() {},
      // starting callback function before each string
      preStringTyped: function() {},
      //callback for every typed string
      onStringTyped: function() {},
      // callback for reset
      resetCallback: function() {}
    });

    Typed.new('#subtyped', {
        stringsElement: document.getElementById('subtyped-strings')
      });
  }


});
