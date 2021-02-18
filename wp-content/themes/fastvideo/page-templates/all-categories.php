<?php
/**
 * Template Name: All Categories Page
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>

	<?php dynamic_sidebar( 'header-ad' ); ?>

	<div id="primary" class="content-area">

		<div id="main" class="site-main" >

			<?php
				while ( have_posts() ) : the_post();
			?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header class="entry-header">
						<?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<?php
							the_content();

							echo "<div class=\"all-categories\">";

							$categories = get_categories( '' );
							foreach($categories as $category) {

							    echo '<div class="category-bar"><a href="' . get_category_link( $category->term_id ) . '" title="' . sprintf( __( "View all posts in %s", 'fastvideo' ), $category->name ) . '" ' . '>';

							    echo '<span class="category-name">' . $category->name. '</span><span class="video-count"><strong>' . $category->count . '</strong> <em>' . esc_html__( 'posts', 'fastvideo' ) . '</em></span></a></div> ';
							}
							echo "</div>";

							wp_link_pages( array(
								'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'fastvideo' ),
								'after'  => '</div>',
							) );
						?>
					</div><!-- .entry-content -->

					<?php if ( get_edit_post_link() ) : ?>
						<footer class="entry-footer">
							<?php
								edit_post_link(
									sprintf(
										/* translators: %s: Name of current post */
										esc_html__( 'Edit %s', 'fastvideo' ),
										the_title( '<span class="screen-reader-text">"', '"</span>', false )
									),
									'<span class="edit-link">',
									'</span>'
								);
							?>
						</footer><!-- .entry-footer -->
					<?php endif; ?>
				</article><!-- #post-## -->

			<?php
				endwhile; // End of the loop.
			?>

		</div><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();

