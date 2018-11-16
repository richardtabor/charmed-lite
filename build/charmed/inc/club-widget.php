<?php

/**
 * Theme changelog in footer admin.
 *
 * @param boolean $url URL or not.
 */
function themebeans_sandbox_get_theme( $url ) {

	// Get the parent theme's name.
	$theme = esc_attr( wp_get_theme( get_template() )->get( 'Name' ) );

	// Replace spaces with hypens, and makes it lowercase for links.
	if ( true === $url ) {
		$theme  = strtolower( $theme );
		$theme  = str_replace( ' ', '-', $theme );
		$theme  = preg_replace( '#[ -]+#', '-', $theme );
	}

	return $theme . ' Pro';
}


/**
 * Theme changelog in footer admin.
 *
 * @param string|string $theme URL or not.
 */
function themebeans_get_download_id( $theme ) {

	$download_id = null;

	// Replace spaces with hypens, and makes it lowercase for links.
	if ( 'Ava' === $theme ) {
		$download_id  = '130853';
	} elseif ( 'York Pro' === $theme ) {
		$download_id  = '105665';
	} elseif ( 'Charmed Pro' === $theme ) {
		$download_id  = '75780';
	} else {
		$download_id  = '';
	}

	return $download_id;
}

function themebeans_dashboard_widgets() {
	global $wp_meta_boxes;
	wp_add_dashboard_widget('custom_help_widget', 'ThemeBeans Theme Club', 'themebeans_dashboard_widget_content');
}
add_action('wp_dashboard_setup', 'themebeans_dashboard_widgets');

function themebeans_dashboard_widget_content() {

	echo '
	<a target="_blank" href="https://themebeans.com/checkout?edd_action=add_to_cart&download_id=110096&discount=SANDBOX&utm_source='.themebeans_sandbox_get_theme( true ).'_sandbox&utm_medium=image&utm_campaign=Sandbox%20Admin%20Dashboard%20Widget%20Image">
	<img style="max-width: 100%;" src="' . get_theme_file_uri( '/images/image.png' ) .'"/>
	</a>

	<p style="margin-top: 10px;">Download our entire catalog of beautiful WordPress themes — <em>plus every theme we make for the next year</em> — for less than the price of two!</p>

	<h4 style="font-weight: 600; margin-top: 25px;">Introductory Pricing — $89</h4>
	<p style="margin-bottom: 20px;">Prices for both the annual and lifetime theme club memberships <u>will go up</u> after a limited time... so if you want to join, buy sooner than later.</p>

	<a target="_blank" style="margin-bottom: 15px;" class="button button-primary" href="https://themebeans.com/checkout?edd_action=add_to_cart&download_id=110096&discount=SANDBOX&utm_source='.themebeans_sandbox_get_theme( true ).'_sandbox&utm_medium=image&utm_campaign=Sandbox%20Admin%20Dashboard%20Widget%20Button">Join our Theme Club — $89</a>
	';
}




// Add Custom Link to WordPress Admin Bar
function themebeans_join_toolbar_link($wp_admin_bar) {
    $args = array(
        'id' => 'themebeans-club',
        'title' => 'Join our Theme Club — $89',
        'href' => 'https://themebeans.com/checkout?edd_action=add_to_cart&download_id=110096&discount=SANDBOX&utm_source='.themebeans_sandbox_get_theme( true ).'_sandbox&utm_medium=admin_button&utm_campaign=Sandbox%20Admin%20Bar%20Link',
        'meta' => array(
            'class' => 'themebeans-purchase',
            'title' => 'Join the ThemeBeans Theme Club and get all our WordPress themes'
        )
    );
    $wp_admin_bar -> add_node($args);
}
add_action('admin_bar_menu', 'themebeans_join_toolbar_link', 1000);


// Add Custom Link to WordPress Admin Bar
function themebeans_toolbar_link($wp_admin_bar) {
    $args = array(
        'id' => 'themebeans-purchase',
        'title' => 'Get '.themebeans_sandbox_get_theme( false ).' Only — $59',
        'href' => 'https://themebeans.com/checkout?edd_action=add_to_cart&download_id='.themebeans_get_download_id( themebeans_sandbox_get_theme( false ) ).'&utm_source='.themebeans_sandbox_get_theme( true ).'_sandbox&utm_medium=admin_button&utm_campaign=Sandbox%20Admin%20Bar%20Link',
        'meta' => array(
            'class' => 'themebeans-purchase',
            'title' => 'Buy '.themebeans_sandbox_get_theme( false ).' WordPress Theme'
        )
    );
    $wp_admin_bar -> add_node($args);
}
add_action('admin_bar_menu', 'themebeans_toolbar_link', 1001);


function themebeans_admin_bar_style() { ?>
<style> #wp-admin-bar-themebeans-club .ab-item:after  {
    position: relative;
    float: right;
    font: 400 20px/1 dashicons;
    speak: none;
    padding: 4px 0;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    background-image: none!important;
    margin-left: 6px;
    content: "\f504";
    top: 1px;
}


#wpadminbar .themebeans-purchase {
    background: #0073aa;
    color: #fff;
    float: right;
    /*margin-left: 10px;*/
    padding-left: 10px;
    padding-right: 5px;
}

#wpadminbar .themebeans-purchase:hover {
    background: #008ec2;
    color: #fff;
}

#wpadminbar .themebeans-purchase:hover a,
#wpadminbar .themebeans-purchase:hover a:focus {
    background: #008ec2 !important;
    color: #fff!important;
}

#toplevel_page_sandbox,
#wp-admin-bar-top-secondary,
#test_drive_welcome_notice {
    display: none!important;
}

#menu-appearance .wp-submenu li {
    display: none;
}

#menu-appearance .wp-submenu .hide-if-no-customize {
    display: block;
}

#menu-tools, #menu-users, #menu-posts-fl-builder-template {
    display: none !important;
}

#wp-admin-bar-themebeans-purchase.themebeans-purchase {
	background: #3a424a;
}

#wp-admin-bar-themebeans-purchase.themebeans-purchase:hover a,
#wp-admin-bar-themebeans-purchase.themebeans-purchase:hover,
#wp-admin-bar-themebeans-purchase.themebeans-purchase:hover a:focus {
background: #525e69 !important;
}

</style>

<?php
}
add_action( 'wp_enqueue_scripts', 'themebeans_admin_bar_style' );
add_action( 'admin_enqueue_scripts', 'themebeans_admin_bar_style' );