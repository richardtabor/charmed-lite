<?php
/**
 * Custom admin functions for this theme.
 *
 * @package Charmed
 */
 


/**
 * Post meta additions.
 */
if( is_admin() ) {
	require get_parent_theme_file_path() . '/inc/meta/metaboxes.php';
	require get_parent_theme_file_path() . '/inc/meta/meta-post.php';
	require get_parent_theme_file_path() . '/inc/meta/meta-portfolio.php';
}



/**
 * Pro upgrade functions.
 * Warning: Don't just remove or delete these lines below.
 * You will get errors. 
 */
require get_parent_theme_file_path() . '/inc/upgrade/upgrade-setup.php';	
require get_parent_theme_file_path() . '/inc/upgrade/upgrade.php';	



/**
 * Theme feedback class.
 * Warning: Don't just remove or delete these lines below.
 * You will get errors.  
 */
if( is_admin() ) {
	require get_parent_theme_file_path() . '/inc/feedback.php';
}



/**
 * Register and enqueue a custom stylesheet in the WordPress admin.
 */
function charmed_enqueue_admin_style() {
     wp_register_style( 'admin_style', get_theme_file_uri() . '/css/admin-style.css', false, '1.0.0' );
     wp_enqueue_style(  'admin_style' );
}
add_action( 'admin_enqueue_scripts', 'charmed_enqueue_admin_style' );



/**
 * Enqueue a script in the WordPress admin, for edit.php, post.php and post-new.php.
 *
 * @param int $hook Hook suffix for the current admin page.
 */
function charmed_meta_enqueue_admin_script($hook) {
	if( $hook != 'edit.php' && $hook != 'post.php' && $hook != 'post-new.php' ) 
		return;
	wp_enqueue_script( 'meta', get_theme_file_uri() . '/inc/meta/js/meta.js', array( 'jquery' ), CHARMED_VERSION, true );
}
add_action('admin_enqueue_scripts', 'charmed_meta_enqueue_admin_script');