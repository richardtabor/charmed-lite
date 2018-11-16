<?php
/**
 * The file for displaying the more portfolio page filter.
 * It is called via the header.php.
 *
 * @subpackage Charmed
 */


/**
 * Loop Variables
 */
if ( 'post' == get_post_type() ) {
	$loop_terms = 'category';  
} else {
	$loop_terms = 'portfolio_category';  
} ?>

<div class="project-filter hide-on-mobile">
	
	<h6 class="widget-title"><?php esc_html_e( 'Tags', 'charmed' ); ?></h6>

	<ul class="filter-group">
		
		<li><a href="javascript:void(0);" id="filter-close" class="active" data-filter="*"><?php esc_html_e( 'All' , 'charmed' ); ?></a></li>

		<?php 
		$terms = get_terms( $loop_terms );
		foreach( $terms as $term ) {
			echo balanceTags('<li><a href="javascript:void(0);" data-filter=".' . $term->term_id .'">' . $term->name . '</a></li>');
		} ?>

	</ul><!-- END .filter-group -->

</div>