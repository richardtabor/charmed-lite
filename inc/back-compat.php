<?php
/**
 * Charmed back compat functionality
 *
 * Prevents Charmed from running on WordPress versions prior to 4.7,
 * since this theme is not meant to be backward compatible beyond that and
 * relies on many newer functions and markup changes introduced in 4.7.
 *
 * @package Charmed
 */


/**
 * Prevent switching to Charmed on old versions of WordPress.
 *
 * Switches to the default theme.
 */
function charmed_switch_theme() {
	switch_theme( WP_DEFAULT_THEME, WP_DEFAULT_THEME );
	unset( $_GET['activated'] );
	add_action( 'admin_notices', 'charmed_upgrade_notice' );
}
add_action( 'after_switch_theme', 'charmed_switch_theme' );


/**
 * Add message for unsuccessful theme switch.
 *
 * Prints an update nag after an unsuccessful attempt to switch to
 * Charmed on WordPress versions prior to 4.7.
 */
function charmed_upgrade_notice() {
	$message = sprintf( esc_html__( 'Charmed requires at least WordPress version 4.7. You are running version %s. Please upgrade and try again.', 'charmed' ), $GLOBALS['wp_version'] );
	printf( '<div class="error"><p>%s</p></div>', $message );
}


/**
 * Prevent the Customizer from being loaded on WordPress versions prior to 4.7.
 *
 */
function charmed_customize() {
	wp_die( sprintf( esc_html__( 'Charmed requires at least WordPress version 4.7. You are running version %s. Please upgrade and try again.', 'charmed' ), $GLOBALS['wp_version'] ), '', array(
		'back_link' => true,
	) );
}
add_action( 'load-customize.php', 'charmed_customize' );


/**
 * Prevent the Theme Preview from being loaded on WordPress versions prior to 4.7.
 *
 */
function charmed_preview() {
	if ( isset( $_GET['preview'] ) ) {
		wp_die( sprintf( esc_html__( 'Charmed requires at least WordPress version 4.7. You are running version %s. Please upgrade and try again.', 'charmed' ), $GLOBALS['wp_version'] ) );
	}
}
add_action( 'template_redirect', 'charmed_preview' );