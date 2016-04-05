/**
 * This file adds some LIVE to the Theme Customizer live preview. To leverage
 * this, set your custom settings to 'postMessage' and then add your handling
 * here. This javascript will grab settings from customizer controls, and 
 * then make any necessary changes to the page using jQuery.
 */
 
( function( $ ) {

	wp.customize( 'blogname', function( value ) {
		value.bind( function( newval ) {
			$( '.site-logo-link a' ).html( newval );
		} );
	} );
	
	wp.customize( 'header_introduction', function( value ) {
		value.bind( function( newval ) {
			$( '.site-description' ).html( newval );
		} );
	} );

	wp.customize( 'contact_button', function( value ) {
		value.bind( function( newval ) {
			$( '.bean-contact-form .button' ).html( newval );
		} );
	} );

	wp.customize( 'contact_email', function( value ) { } );

	wp.customize( 'powered_by_charmed', function( value ) {
		value.bind( function( to ) {
			if ( true === to ) {
				$( '.powered-by-charmed' ).removeClass( 'hidden' );
			} else {
				$( '.powered-by-charmed' ).addClass( 'hidden' );
			}
		} );
	} );

	wp.customize( 'powered_by_wordpress', function( value ) {
		value.bind( function( to ) {
			if ( true === to ) {
				$( '.powered-by-wordpress' ).removeClass( 'hidden' );
			} else {
				$( '.powered-by-wordpress' ).addClass( 'hidden' );
			}
		} );
	} );

} )( jQuery );