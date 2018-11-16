<?php
/**
 * Charmed functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Charmed
 * @author  Rich Tabor, ThemeBeans
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU Public License
 */



/**
 * Set constant for version.
 */
define( 'CHARMED_VERSION', '1.1.4' );



/**
 * Check to see if development mode is active.
 * If set the 'true', then serve standard theme files,
 * instead of minified .css and .js files.
 */
define( 'CHARMED_DEBUG', false );



/**
 * Charmed only works in WordPress 4.2 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.2', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}



/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
if ( ! function_exists( 'charmed_setup' ) ) :
function charmed_setup() {



	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Charmed, use a find and replace
	 * to change 'charmed' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'charmed', get_template_directory() . '/languages' );



	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );



	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );



    /*
     * Enable support for site logo.
     * It's not quite ready yet, so I've commented it out.
     */
    //add_image_size( 'charmed-logo', 200, 200 );
    //add_theme_support( 'custom-logo', array( 'size' => 'charmed-logo' ) );



	/**
	 * Filter Charmed's custom-background support argument.
	 *
	 * @param array $args {
	 *     An array of custom-background support arguments.
	 * }
	 */
	$args = array(
		'default-color' => 'ffffff',
	);
	add_theme_support( 'custom-background', $args );



	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 140, 140, true );
	add_image_size( 'sml-thumbnail', 50, 50, true );
	add_image_size( 'page-feat', 600, 9999 );
	add_image_size( 'port-full', 9999, 9999, false  );
	add_image_size( 'port-grid', 500, 9999 );
	add_image_size( 'port-grid@2x', 1000, 9999 );
	add_image_size( 'port-grid-mobile', 375, 9999 );



	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'charmed' ),
	) );



	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );



	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'video'
	) );



	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'css/editor-style.css' ) );


    /*
     * Enable support for Customizer Selective Refresh.
     * See: https://make.wordpress.org/core/2016/02/16/selective-refresh-in-the-customizer/
     */
    add_theme_support( 'customize-selective-refresh-widgets' );



}
endif; // charmed_setup
add_action( 'after_setup_theme', 'charmed_setup' );



/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function charmed_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'bean_content_width', 644 );
}
add_action( 'after_setup_theme', 'charmed_content_width', 0 );



/**
 * Register widget areas.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function charmed_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Theme Sidebar', 'charmed' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Appears at the side, under the header.', 'charmed' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h6 class="widget-title">',
		'after_title'   => '</h6>',
	) );
}
add_action( 'widgets_init', 'charmed_widgets_init' );



/**
 * JavaScript Detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 */
function charmed_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'charmed_javascript_detection', 0 );



/**
 * Enqueue scripts and styles.
 */
function charmed_scripts() {

	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'charmed-fonts', charmed_fonts_url(), array(), null );

	/**
	 * Check whether WP_DEBUG or SCRIPT_DEBUG or CHARMED_DEBUG is set to true.
	 * If so, we’ll load the unminified versions of the main theme stylesheet. If not, load the compressed and combined version.
	 * This is also similar to how WordPress core does it.
	 *
	 * @link https://codex.wordpress.org/WP_DEBUG
	 */
	if ( WP_DEBUG || SCRIPT_DEBUG || CHARMED_DEBUG ) {
		// Add the main stylesheet.
		wp_enqueue_style( 'charmed-style', get_stylesheet_uri() );
	} else {
		// Add the main minified stylesheet.
		wp_enqueue_style('charmed-minified-style', get_template_directory_uri(). '/style-min.css', false, '1.0', 'all');
	}

	// Load the standard WordPress comments reply javascript.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Load the contact and comment form validation scripts.
	if ( is_page_template('template-contact.php') ) {
		wp_enqueue_script( 'validation', 'http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js', array( 'jquery' ), CHARMED_VERSION, true );
	}

	wp_enqueue_script('jquery');

	/**
	 * Now let's check the same for the scripts.
	 */
	if ( WP_DEBUG || SCRIPT_DEBUG || CHARMED_DEBUG || is_child_theme() ) {

		// Load the Picturefill script for serving retina images.
		wp_enqueue_script( 'picturefill', get_template_directory_uri() . '/js/src/picturefill.js', array( 'jquery' ), CHARMED_VERSION, true );

		// Load the ImagesLoaded javascript.
		wp_enqueue_script( 'imagesloaded', get_template_directory_uri() . '/js/src/images-loaded.js', array( 'jquery' ), CHARMED_VERSION, true );

		// Load the Isotope script for the masonry layout.
		wp_enqueue_script( 'isotope', get_template_directory_uri() . '/js/src/isotope.js', array( 'jquery' ), CHARMED_VERSION, true );

		// Load the Infinite Scroll javascript.
		wp_enqueue_script( 'infinitescroll', get_template_directory_uri() . '/js/src/infinitescroll.js', array( 'jquery' ), CHARMED_VERSION, true );

		// Load the NProgress progress bar loader javascript.
		wp_enqueue_script( 'nprogress', get_template_directory_uri() . '/js/src/nprogress.js', array( 'jquery' ), CHARMED_VERSION, true );

		// Load the FitVids responsive video javascript.
		wp_enqueue_script( 'fitvids', get_template_directory_uri() . '/js/src/fitvids.js', array( 'jquery' ), CHARMED_VERSION, true );

		// Load the custom theme javascript functions.
		wp_enqueue_script( 'charmed-functions', get_template_directory_uri() . '/js/src/functions.js', array( 'jquery' ), CHARMED_VERSION, true );

	} else {
		// Load the combined javascript library.
		wp_enqueue_script( 'charmed-combined-scripts', get_template_directory_uri() . '/js/combined-min.js', array(), CHARMED_VERSION, true );

		// Load the minified javascript functions.
		wp_enqueue_script( 'charmed-minified-functions', get_template_directory_uri() . '/js/functions-min.js', array( 'jquery' ), CHARMED_VERSION, true );
	}
}
add_action( 'wp_enqueue_scripts', 'charmed_scripts' );



if ( ! function_exists( 'charmed_fonts_url' ) ) :
/**
 * Register Google fonts for Charmed.
 *
 * @return string Google fonts URL for the theme.
 */
function charmed_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = '';

	/* translators: If there are characters in your language that are not supported by Karla, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== esc_html_x( 'on', 'Karla font: on or off', 'charmed' ) ) {
		$fonts[] = 'Karla';
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), 'https://fonts.googleapis.com/css' );
	}

	return $fonts_url;
}
endif;



if ( ! function_exists( 'charmed_protected_title_format' ) ) :
/**
 * Filter the text prepended to the post title for protected posts.
 * Create your own charmed_protected_title_format() to override in a child theme.
 *
 * @link https://developer.wordpress.org/reference/hooks/protected_title_format/
 */
function charmed_protected_title_format($title) {
	return '%s';
}
add_filter('protected_title_format', 'charmed_protected_title_format');
endif;



if ( ! function_exists( 'charmed_protected_form' ) ) :
/**
 * Filter the HTML output for the protected post password form.
 * Create your own charmed_protected_form() to override in a child theme.
 *
 * @link https://developer.wordpress.org/reference/hooks/the_password_form/
 * @link https://codex.wordpress.org/Using_Password_Protection
 */
function charmed_protected_form() {
    global $post;

    $label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );

    $o = '<form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post">
    <label for="' . $label . '">' . __( "Password:", 'charmed' ) . ' </label><input name="post_password" placeholder="' . __( "Enter password & press enter...", 'charmed' ) . '" type="password" placeholder=""/><input type="submit" name="Submit" value="' . esc_attr__( 'Submit', 'charmed' ) . '" />
    </form>
    ';

    return $o;
}
add_filter( 'the_password_form', 'charmed_protected_form' );
endif;



if ( ! function_exists( 'charmed_getPostViews' ) ) :
/**
 * Loop by post view count.
 * Create your own charmed_getPostViews() to override in a child theme.
 */
function charmed_getPostViews($postID) {
	$count_key = 'post_views_count';
	$count = get_post_meta($postID, $count_key, true);

	if($count==''){
		delete_post_meta($postID, $count_key);
		add_post_meta($postID, $count_key, '0');
	return '0';
 	}

 	return $count;
}
endif;



if ( ! function_exists( 'charmed_setPostViews' ) ) :
/**
 * Output the view count.
 * Create your own charmed_setPostViews() to override in a child theme.
 */
function charmed_setPostViews($postID) {
	$count_key = 'post_views_count';
	$count = get_post_meta($postID, $count_key, true);

	if($count==''){
		$count = 0;
		delete_post_meta($postID, $count_key);
		add_post_meta($postID, $count_key, '0');
	} else {
		$count++;
		update_post_meta($postID, $count_key, $count);
	}
}
endif;



if ( ! function_exists( 'charmed_pingback_header' ) ) :
/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function charmed_pingback_header() {
    if ( is_singular() && pings_open() ) {
        echo '<link rel="pingback" href="', bloginfo( 'pingback_url' ), '">';
    }
}
add_action( 'wp_head', 'charmed_pingback_header' );
endif;



/**
 * Admin specific functions.
 */
require get_template_directory() . '/inc/admin.php';



/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer/customizer.php';
require get_template_directory() . '/inc/customizer/customizer-css.php';
require get_template_directory() . '/inc/customizer/sanitization.php';



/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';



/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';



/**
 * Add Widgets.
 */
require get_template_directory() . '/inc/widgets/widget-flickr.php';
require get_template_directory() . '/inc/widgets/widget-portfolio-menu.php';