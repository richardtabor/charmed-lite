<?php
/**
 * Enqueues front-end CSS for Customizer options.
 *
 * @package Charmed
 */

if ( !function_exists('Bean_Customize_Variables') ) {

function Bean_Customize_Variables() {

		// Colors
		$theme_accent_color = get_theme_mod('theme_accent_color', '#007AFF');
		$body_typography_color = get_theme_mod('body_typography_color', '#101C38');
		$header_a_color = get_theme_mod('header_a_color', '#101C38');
		$footer_color = get_theme_mod('footer_color', '#bbbbbb');
		$widget_title_color = get_theme_mod('wt_color', '#bbbbbb');	

		// Fonts     
		$body_font_size = get_theme_mod('body_font_size', '15');
		$body_line_height = get_theme_mod('body_line_height', '26');
		$body_letter_spacing = get_theme_mod('body_letter_spacing', '0');
		$body_word_spacing = get_theme_mod('body_word_spacing', '0');

		$pagetitle_font_family = get_theme_mod('pagetitle_font_family', 'Karla');
		$pagetitle_font_size = get_theme_mod('pagetitle_font_size', '26');
		$pagetitle_line_height = get_theme_mod('pagetitle_line_height', '26');
		$pagetitle_letter_spacing = get_theme_mod('pagetitle_letter_spacing', '0');
		$pagetitle_word_spacing = get_theme_mod('pagetitle_word_spacing', '0');

		$pagecontent_font_size = get_theme_mod('pagecontent_font_size', '19');
		$pagecontent_line_height = get_theme_mod('pagecontent_line_height', '32');
		$pagecontent_word_spacing = get_theme_mod('pagecontent_word_spacing', '0');

		?>

		<style>

			<?php
			$customizations = 
			'
			a:hover,
			a:focus,
			a:active,
			.entry-content p a,
			body .site-footer a:hover, 
			body .header .project-filter a:hover,
			body .header .main-navigation a:hover,
			body .header .project-filter a.active, 
			.logo_text:hover,
			.widget ul li a:hover,
			.current-menu-item a, 
			.portfolio .project-meta a:hover,
			.page-links a span:not(.page-links-title):hover,
			.page-links span:not(.page-links-title) { color:'.$theme_accent_color.'; }

			.cats,
			h1 a:hover, 
			.logo a h1:hover,
			.tagcloud a:hover,
			nav ul li a:hover,
			.widget li a:hover,
			.entry-meta a:hover,
			.header-alt a:hover,
			.pagination a:hover,
			.post-after a:hover,
			.bean-tabs > li.active > a,
			.bean-panel-title > a:hover,
			.archives-list ul li a:hover,
			nav ul li.current-menu-item a,
			.bean-tabs > li.active > a:hover,
			.bean-tabs > li.active > a:focus,
			.bean-pricing-table .pricing-column li.info:hover { 
				color:'.$theme_accent_color.'!important; 
			}

			button:hover,
			button:focus,
			.button:hover,
			.button:focus,
			input[type="button"]:hover,
			input[type="button"]:focus,
			input[type="reset"]:hover,
			input[type="reset"]:focus,
			input[type="submit"]:hover,
			input[type="submit"]:focus {
				border-color:'.$theme_accent_color.'; 
			}
			
			button:hover,
			button:focus,
			.button:hover,
			.button:focus,
			input[type="button"]:hover,
			input[type="button"]:focus,
			input[type="reset"]:hover,
			input[type="reset"]:focus,
			input[type="submit"]:hover,
			input[type="submit"]:focus,
			.bean-btn,
			.tagcloud a,
			nav a h1:hover, 
			div.jp-play-bar,
			#nprogress .bar,
			.avatar-list li a.active,
			div.jp-volume-bar-value,
			.bean-direction-nav a:hover,
			.bean-pricing-table .table-mast,
			.entry-categories a:hover, 
			.pagination .prev:hover,
			.pagination .prev:focus,
			.pagination .next:hover,
			.pagination .next:focus,
			.bean-contact-form .bar:before, 
			.post .post-slider.fade .bean-direction-nav a:hover { 
				background-color:'.$theme_accent_color.'; 
			}

			.bean-btn { border: 1px solid '.$theme_accent_color.'!important; }
			.bean-quote { background-color:'.$theme_accent_color.'!important; }
			';  

			$css_filter_style = get_theme_mod( 'css_filter' );
			if( $css_filter_style != '' ) {
				switch ( $css_filter_style ) {
					case 'none':
					break;
					case 'grayscale':
					echo '.brick-fullwidth .brick { filter: url("data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\'><filter id=\'grayscale\'><feColorMatrix type=\'matrix\' values=\'0.3333 0.3333 0.3333 0 0 0.3333 0.3333 0.3333 0 0 0.3333 0.3333 0.3333 0 0 0 0 0 1 0\'/></filter></svg>#grayscale"); filter:gray; -webkit-filter:grayscale(100%);-moz-filter: grayscale(100%);-o-filter: grayscale(100%);}';
					break;
					case 'sepia':
					echo '.brick-fullwidth .brick { -webkit-filter: sepia(50%); }';
					break;
					case 'saturation':
					echo '.brick-fullwidth .brick { -webkit-filter: saturate(150%); }';
					break;      
				}
			}


			/**
			 * Combine the values from above and minifiy them.
			 */
			$customizer_final_output =  $customizations ;

			$final_output = preg_replace('#/\*.*?\*/#s', '', $customizer_final_output);
			$final_output = preg_replace('/\s*([{}|:;,])\s+/', '$1', $final_output);
			$final_output = preg_replace('/\s\s+(.*)/', '$1', $final_output);
			echo $final_output;
			?>
		</style>

<?php } 
add_action( 'wp_head', 'Bean_Customize_Variables', 1 );
}