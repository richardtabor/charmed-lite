<?php
/**
 * The file for displaying the related portfolio loop below the portfolio single.
 * It is called via the related posts function in functions.php.
 * You can set the count via the $related_items_count variable.
 *  
 * @subpackage Charmed
 */



/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the content.
 */
if ( post_password_required() ) {
	return;
}



/*
 * Set variables for the content below.
 */
$portfolio_date = get_post_meta($post->ID, '_bean_portfolio_date', true); 
$portfolio_client = get_post_meta($post->ID, '_bean_portfolio_client', true); 
$portfolio_role = get_post_meta($post->ID, '_bean_portfolio_role', true); 
$portfolio_views = get_post_meta($post->ID, '_bean_portfolio_views', true); 
$portfolio_cats = get_post_meta($post->ID, '_bean_portfolio_cats', true);
$portfolio_tags = get_post_meta($post->ID, '_bean_portfolio_tags', true);
$portfolio_url = get_post_meta($post->ID, '_bean_portfolio_url', true); 
$portfolio_url_clean = str_replace("http://","",$portfolio_url);
$portfolio_url_clean = preg_replace('/\s+/', '', $portfolio_url_clean); 
?>

<div class="project-meta">

	<?php if ($portfolio_date == 'on') { ?> 
		<h6 class="published">
			<?php esc_html_e( 'Date: ', 'charmed' ); ?><span><?php the_time('M Y') ?></span>
		</h6>	
	<?php } ?>

	<?php if ($portfolio_role) { ?>
		<h6 class="role">
			<?php esc_html_e( 'Role: ', 'charmed' ); ?><span><?php echo esc_html( $portfolio_role ); ?></span>
		</h6>
	<?php } ?>

	<?php if ($portfolio_client) { ?>
		<h6 class="client">
			<?php esc_html_e( 'Client: ', 'charmed' ); ?>
			<span>
			<?php if ($portfolio_url) { ?>
				<a href="<?php echo esc_url($portfolio_url); ?>" target="blank"><?php echo esc_html( $portfolio_client ); ?></a>
			<?php } else { 
				echo esc_html( $portfolio_client ); 
			} ?>
			</span>
		</h6> 
	<?php } ?>

	<?php if ($portfolio_url && !$portfolio_client ) { ?>
		<h6 class="url">
			<?php esc_html_e( 'URL: ', 'charmed' ); ?><span><a href="<?php echo esc_url($portfolio_url); ?>" target="blank"><?php echo esc_html( $portfolio_url_clean ); ?></a></span>
		</h6>
	<?php } ?>

	<?php if ($portfolio_views == 'on') { // DISPLAY VIEWS ?>	
		<h6 class="views">
			<?php esc_html_e( 'Views: ', 'charmed' ); ?><span><?php echo esc_html(charmed_getPostViews(get_the_ID())); ?></span>
		</h6>
	<?php } ?>

</div>

<?php if ($portfolio_cats == 'on' OR $portfolio_tags == 'on' ) { // DISPLAY TAGS ?>	

	<div class="project-taxonomy">
		<h6>
			<?php if ($portfolio_cats == 'on') { // DISPLAY TAGS ?>	
				<?php $terms = get_the_terms( $post->ID, 'portfolio_category' ); ?>
				<?php if ( $terms && ! is_wp_error( $terms ) ) : ?>
					<?php the_terms($post->ID, 'portfolio_category','#', '&nbsp;&nbsp;#', '&nbsp;&nbsp;'); ?>
				<?php endif;?>
			<?php } ?>

			<?php if ($portfolio_tags == 'on') { // DISPLAY CATEGORY ?>	
					<?php the_terms($post->ID, 'portfolio_tag','#', '&nbsp;&nbsp;&nbsp;#', '&nbsp;&nbsp;'); ?>
			<?php } ?>
		</h6>
	</div>

<?php } ?>