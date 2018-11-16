<?php
/**
 * The header for our theme.
 *
 * @package Charmed
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class('clearfix'); ?>>

<div id="page" class="hfeed site page-container clearfix">

<?php if ( !is_404() ) : ?>

	<header id="masthead" class="site-header header brick" data-views="99999999999999999999" data-date="<?php echo date('YndHis'); ?>">

		<div class="inner">

            <?php charmed_site_logo(); ?>

            <?php
			$description = get_bloginfo( 'description', 'display' );
			if ( $description || is_customize_preview() ) : ?>
				<p class="site-description"><?php echo $description; ?></p>
			<?php endif; ?>

			<?php if ( has_nav_menu( 'primary' ) ) : ?>

				<nav id="site-navigation" class="main-navigation nav primary">
					<?php
					wp_nav_menu( array(
						'theme_location' => 'primary',
						'menu_class'     => 'primary-emnu',
						'depth'		  => '1',
					 ) );
					?>

				</nav><!-- .main-navigation -->

				<a id="nav-btn" class="mobile-menu-toggle" href="javascript:void(0);"><span><?php _e( 'Navigation' , 'charmed' ); ?></span></a>

			<?php endif;

			//Retrieve the portfolio fitler, only for the Portfolio template.
			if ( is_front_page() AND is_home() OR is_page_template('template-portfolio.php') ) {
				get_template_part( 'template-parts/portfolio-filter');
			}

			//Output the following to the singular formats, except pages.
			if ( is_singular('post') OR is_singular('portfolio') ) {

				if (have_posts()) : while (have_posts()) : the_post(); ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<?php the_title( '<h2 class="entry-title">', '</h2>'); ?>
						<?php the_content(); ?>
						<?php get_template_part( 'template-parts/portfolio-meta'); ?>
					</article>

				<?php endwhile; endif;
			} else {
				if ( !is_page_template('template-portfolio.php') ) {
					get_sidebar();
				}
			} ?>

			<div class="site-footer">

				<?php $visibility = ( false == get_theme_mod( 'powered_by_charmed' ) ) ? 'hidden' : '' ?>

				<a href="http://themebeans.com/themes/charmed/" class="powered-by-charmed <?php echo esc_html($visibility); ?>"><?php printf( __( 'Powered by %s', 'charmed' ), 'Charmed' ); ?></a>

				<?php $visibility = ( false == get_theme_mod( 'powered_by_wordpress' ) ) ? 'hidden' : '' ?>

				<a href="http://wordpress.org/" class="powered-by-wordpress <?php echo esc_html($visibility); ?>"><?php printf( __( 'A %s run site. Nice.', 'charmed' ), 'WordPress' ); ?></a>

			</div>

		</div><!--  .inner -->

	</header><!-- .site-header -->

	<div class="brick-fullwidth brick">

<?php endif; ?>