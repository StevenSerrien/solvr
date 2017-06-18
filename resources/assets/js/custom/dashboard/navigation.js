/**
 * main3.js
 * http://www.codrops.com
 *
 * Licensed under the MIT license.
 * http://www.opensource.org/licenses/mit-license.php
 *
 * Copyright 2014, Codrops
 * http://www.codrops.com
 */
(function() {

	var bodyEl = document.body,
		container = document.querySelector( '.d-container' ),
		openbtn = document.getElementById( 'side-menu-trigger' ),
    content = document.querySelector( '.content-wrap' ),
		closebtn = document.getElementById( 'd-sidemenu-close' ),
		isOpen = false;


		function init() {
			initEvents();
		}
		
		function initEvents() {
			openbtn.addEventListener( 'click', toggleMenu );

			closebtn.addEventListener( 'click', toggleMenu );


			if (isOpen) {
				closebtn.on('click', function() {

				});
			}

			// close the menu element if the target it´s not the menu element or one of its descendants..
			content.addEventListener( 'click', function(ev) {

				var target = ev.target.parentNode;

				if( isOpen && target !== openbtn ) {
					toggleMenu();

				}
			} );
		}

		function toggleMenu() {
			if( isOpen ) {
				classie.remove( container, 'show-menu' );

			}
			else {
				classie.add( container, 'show-menu' );
			}

			isOpen = !isOpen;
		}

		init();

})();
