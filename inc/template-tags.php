<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Charmed
 */



if ( ! function_exists( 'charmed_site_logo' ) ) :
/**
 * Output an <img> tag of the site logo.
 *
 * Checks if jetpack_the_site_logo is available. If so, use  jetpack_the_site_logo();.
 * If not, there's a fallback of site_logo in the Theme Customizer.
 *
 */
function charmed_site_logo() {

	if ( function_exists( 'jetpack_the_site_logo' ) ) : 
		if ( jetpack_has_site_logo() ) { jetpack_the_site_logo(); } 
		else { ?> <h1 class="site-logo-link"><a href="<?php echo esc_url( home_url('/') ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1><?php }
	else : 
		if( get_theme_mod( 'site_logo' )) { ?> 
		  	<a class="site-logo-link" href="<?php echo esc_url( home_url('/') ); ?>" rel="home"><img style="<?php charmed_retina_logo(); ?>" src="<?php echo esc_url( get_theme_mod( 'site_logo' ) );?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" class="site-logo"></a>
		<?php
		} else { ?>
		  	<h1 class="site-logo-link"><a href="<?php echo esc_url( home_url('/') ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
		<?php }
	endif; 
}
endif;



if ( ! function_exists( 'charmed_the_site_logo' ) ) :
/**
 * Displays the optional site logo.
 * Returns early if the site logo is not available.
 */
function charmed_the_site_logo() {

    if ( ! function_exists( 'the_custom_logo' ) ) {
        charmed_site_logo();
    } else {
        the_custom_logo();
    }
}
endif;



if ( ! function_exists( 'charmed_retina_logo' ) ) :
/**
* Output the width of the uploaded image, at 1/2 the original size.
*
* Create your own charmed_retina_logo() to override in a child theme.
*
*/
function charmed_retina_logo( $location ) {
    
    $data = get_theme_mod( 'site_logo_width' ); 
    $width = 'width:'.$data.'px;';
    echo $width;
}
endif;



if ( ! function_exists( 'charmed_picturefill' ) ) :
/**
 * Utilizes picturefill.js to serve specific image assets where it makes sense to.
 * Create your own charmed_picturefill() to override in a child theme.
 */
function charmed_picturefill($post_id) {
	$feat_image = wp_get_attachment_image_src( get_post_thumbnail_id($post_id), 'port-grid');
	$feat_image_2x = wp_get_attachment_image_src( get_post_thumbnail_id($post_id), 'port-grid@2x');
	$feat_image_mobile = wp_get_attachment_image_src( get_post_thumbnail_id($post_id), 'port-grid-mobile');

	echo'<span class="project-img" data-picture data-alt="'.esc_attr(get_the_title($post_id)).'">';
		echo'<span data-src="'.esc_html($feat_image[0]).'"></span>';
		echo'<span data-src="'.esc_html($feat_image_mobile[0]).'" data-media="(max-width: 414px)"></span>';	
		echo'<span data-src="'.esc_html($feat_image_2x[0]).'" data-media="(min-device-pixel-ratio: 2.0),(-webkit-min-device-pixel-ratio: 2),(min--moz-device-pixel-ratio: 2),(-o-min-device-pixel-ratio: 2/1),(min-device-pixel-ratio: 2),(min-resolution: 192dpi),(min-resolution: 2dppx)"></span>';
		echo'<span data-src="'.esc_html($feat_image[0]).'" data-media="(max-width : 414px) and (-webkit-device-pixel-ratio: 2)"></span>';		
		echo'<noscript><img src="'.esc_html($feat_image[0]).'" alt="'.esc_attr(get_the_title($post_id)).'"></noscript>';
	echo'</span>';
}
endif;



if ( ! function_exists( 'charmed_article_background' ) ) :
/**
 * Return the hero background image.
 * 
 * Checks if a featured image is uploaded and creates a background image CSS rule
 * Create your own charmed_article_background() to override in a child theme.
 *
 * @see https://codex.wordpress.org/Function_Reference/wp_get_attachment_url
 * @see https://codex.wordpress.org/Function_Reference/get_post_thumbnail_id
 * @see https://codex.wordpress.org/Function_Reference/has_post_thumbnail 
 */
function charmed_article_background( ) {
	global $post;

		$hero_bg_img = 'background-image: url(' . charmed_gallery_first_image($post->ID) . ');'; 
		return $hero_bg_img;
}
endif;



if ( !function_exists( 'charmed_portfolio_tags' ) ) :
/**
 * 
 * Create your own charmed_portfolio_tags() to override in a child theme.
 */
function charmed_portfolio_tags() {
	global $post;
	
	$terms = wp_get_post_terms( $post->ID, 'portfolio_tag' );
	
	if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
		echo '<div class="project-tags">';
			foreach ( $terms as $term ) {
				echo '<span>#' . $term->name . '</span>';
			}
		echo '</div>';
	}
}
endif;



if ( !function_exists( 'charmed_gallery_first_image' ) ) :
/**
 * 
 * Create your own charmed_gallery_first_image() to override in a child theme.
 */
function charmed_gallery_first_image($postid) {

	global $post;

	$thumb_ID = get_post_thumbnail_id( $postid );
	$image_ids_raw = get_post_meta($postid, '_bean_image_ids', true);

	if( $image_ids_raw != '' ) {
		$image_ids = explode(',', $image_ids_raw);
		$post_parent = null;
	} else {
		$image_ids = '';
		$post_parent = $postid;
	}

	$args = array(
		'exclude' => $thumb_ID,
		'include' => $image_ids,
		'numberposts' => 1,
		'orderby' => 'post__in',
		'order' => 'DESC',
		'post_type' => 'attachment',
		'post_parent' => $post_parent,
		'post_mime_type' => 'image',
		'post_status' => null,
		);
	$attachments = get_posts($args);
	
	if( !empty($attachments) ) {
					
		foreach( $attachments as $attachment ) {

			$src = wp_get_attachment_image_src( $attachment->ID, 'portfolio-grid' ); 

			$first_image = $src[0];
			
		} //END foreach( $attachments as $attachment )

		return $first_image;

	} // END if( !empty($attachments) )
}
endif;



if ( ! function_exists( 'charmed_gallery' ) ) :
/**
 * Return the portfolio and post galleries.
 * 
 * Checks if there are images uploaded to the post or portfolio post and outputs them.
 * Create your own charmed_gallery() to override in a child theme.
 */
function charmed_gallery($postid, $imagesize = '', $layout = '', $orderby = '', $single = false )
{
	$thumb_ID = get_post_thumbnail_id( $postid );
	$image_ids_raw = get_post_meta($postid, '_bean_image_ids', true);

	//Post meta
	$embed = get_post_meta($postid, '_bean_portfolio_embed_code', true);
	$embed2 = get_post_meta($postid, '_bean_portfolio_embed_code_2', true);
	$embed3 = get_post_meta($postid, '_bean_portfolio_embed_code_3', true);
	$embed4 = get_post_meta($postid, '_bean_portfolio_embed_code_4', true);
	$video_shortcodes = get_post_meta($postid, '_bean_portfolio_video_shortcodes', true);

	wp_reset_postdata();

	if( $image_ids_raw != '' )
	{
		$image_ids = explode(',', $image_ids_raw);
		$post_parent = null;
	} else {
		$image_ids = '';
		$post_parent = $postid;
	}

	$i = 1;

	//Pull in the image assets
	$args = array(
		'exclude' => $thumb_ID,
		'include' => $image_ids,
		'numberposts' => -1,
		'orderby' => 'post__in',
		'order' => 'ASC',
		'post_type' => 'attachment',
		'post_parent' => $post_parent,
		'post_mime_type' => 'image',
		'post_status' => null,
		);
	$attachments = get_posts($args); ?>

		<div id="project-assets-<?php echo esc_html($postid); ?>" class="project-assets <?php if( get_theme_mod( 'portfolio_lazyload' ) == true) { echo 'lazy-load'; } ?>" itemscope itemtype="http://schema.org/ImageGallery">
			
			<?php
			if ( !post_password_required() ) {
				
				if($embed) {
					echo '<figure class="video-frame">';
						echo stripslashes(htmlspecialchars_decode($embed));
					echo '</figure>';
				}

				if($embed2) {
					echo '<figure class="video-frame">';
						echo stripslashes(htmlspecialchars_decode($embed2));
					echo '</figure>';
				}

				if($embed3) {
					echo '<figure class="video-frame">';
						echo stripslashes(htmlspecialchars_decode($embed3));
					echo '</figure>';
				}

				if($embed4) {
					echo '<figure class="video-frame">';
						echo stripslashes(htmlspecialchars_decode($embed4));
					echo '</figure>';
				}

				if($video_shortcodes) {	
					echo '<figure class="video-frame">';
						echo do_shortcode(''.$video_shortcodes.'');
					echo '</figure>';
				}

			}

			if( !empty($attachments) ) { 	
				if ( !post_password_required() ) {
					foreach( $attachments as $attachment ) {

						$caption = $attachment->post_excerpt;
						$caption = ($caption) ? "$caption" : '';
						$alt = ( !empty($attachment->post_content) ) ? $attachment->post_content : $attachment->post_title;		    			
						$src = wp_get_attachment_image_src( $attachment->ID, $imagesize ); 
						?>

						<figure itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
							
							<?php  
							echo '<img src="'.$src[0].'"/>';
								
							if ($caption) { echo '<div class="project-caption">'. htmlspecialchars($caption) .'</div>'; } ?>
					
						</figure>

						<?php
					} //END foreach( $attachments as $attachment )
				} //!post_password_required()
			} // END if( !empty($attachments) )

		echo '</div>';

} // END function charmed_gallery
endif;



/**
 * Determine whether blog/site has more than one category.
 *
 * @return bool True of there is more than one category, false otherwise.
 */
function charmed_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'charmed_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'charmed_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so charmed_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so charmed_categorized_blog should return false.
		return false;
	}
}



/**
 * Flush out the transients used in { @see charmed_categorized_blog() }.
 */
function charmed_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'charmed_categories' );
}
add_action( 'edit_category', 'charmed_category_transient_flusher' );
add_action( 'save_post',     'charmed_category_transient_flusher' );