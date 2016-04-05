<?php
/**
 * The template used for displaying page content
 *
 * @package Charmed
 */ 
 ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<div class="entry-content">
		
		<?php

		the_title( '<h2 class="entry-title">', '</h2>');

		if ( has_post_thumbnail() ) { 
			echo '<div class="entry-media">'; 
				the_post_thumbnail('page-feat'); 
			echo '</div>'; }
		
		the_content();

		wp_link_pages( array(
			'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'charmed' ) . '</span>',
			'after'       => '</div>',
			'link_before' => '<span>',
			'link_after'  => '</span>',
			'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'charmed' ) . ' </span>%',
			'separator'   => '<span class="screen-reader-text">, </span>',
		) );
		?>

	</div><!-- .entry-content -->

</article><!-- #post-## -->