<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package fastvideo
 */

get_header(); ?>

<?php  if ( !have_posts() ) { ?>
	<div class="inner-wrap">
<?php } ?>

	<?php dynamic_sidebar( 'header-ad' ); ?>

	<div id="primary" class="content-area <?php if ( have_posts() ) { echo "layout-1c"; } ?>">
			
		<div id="main" class="site-main" >

		<?php
		
			if ( have_posts() ) :
				get_template_part( 'template-parts/content', 'search');
			else :
				get_template_part( 'template-parts/content', 'none' );

		?>

		<?php endif; ?>

		</div><!-- #main -->
		<?php

			global $wp_version;

			if ( $wp_version >= 4.1 ) :

				the_posts_pagination( array( 'prev_text' => _x( 'Previous', 'previous post', 'fastvideo' ) ) );
			
			endif;

		?>		
	</div><!-- #primary -->

<?php  if ( !have_posts() ) { get_sidebar(); } ?>

<?php  if ( !have_posts() ) { ?>
	</div><!-- .inner-wrap -->
<?php } ?>

<?php get_footer(); ?>
