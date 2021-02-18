<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package fastvideo
 */

get_header(); 

if ( function_exists( 'fastvideo_set_post_views' ) ) :
	fastvideo_set_post_views(get_the_ID());
endif;

?>

	<div id="primary" class="content-area layout-1c">

		<?php	while ( have_posts() ) : the_post(); ?>

		<!-- <div id="main" class="site-main <?php fastvideo_embed_class(); ?>"> -->

		<div class="single-post-content site-column">

			<?php

				get_template_part( 'template-parts/content', 'single' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			?>

		</div><!-- .single-post-content -->

		<?php get_sidebar(); ?>

		<div class="post-navigation">
			<?php next_post_link( '%link', '<span class="genericon genericon-expand"></span>', false ); ?>
			<?php previous_post_link( '%link', '<span class="genericon genericon-collapse"></span>', false ); ?>
		</div>

		</div><!-- #main -->

	<?php endwhile; // End of the loop. ?>

	</div><!-- #primary -->

<?php
get_footer();
?>
