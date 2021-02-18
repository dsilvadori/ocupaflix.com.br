<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package fastvideo
 */

get_header(); ?>

	<div id="primary" class="content-area layout-1c clear">
		<div id="main" class="site-main clear">

			<div class="section-header inner-wrap">

				<?php
					if ( is_category() ) {
						$category = get_category( get_query_var('cat') );
					}
				?>

				<h1>
					<a href="<?php echo esc_url(get_category_link($category->cat_ID)); ?>">
						<?php
							printf( single_cat_title( '', false ) );
						?>
					</a>
				</h1>		
				
			</div><!-- .section-header -->

			<img src="<?php echo get_template_directory_uri();?>/assets/img/ajax-loader.gif" class="ajax-loader" alt="Loading..."/>

			<div class="content-block clear">

				<?php

				if ( have_posts() ) :

				$i = 1;
				/* Start the Loop */
				while ( have_posts() ) : the_post();

					/*
					 * Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
				?>

					<div class="hentry <?php if ( $i % 4 == 0 ) { echo 'last'; } ?>">
						
						<?php if ( has_post_thumbnail() ) { ?>

						<a class="thumbnail-link" href="<?php the_permalink(); ?>">
							<div class="thumbnail-wrap">
								<?php 
									the_post_thumbnail( 'general-thumb' ); 
		        				?>
								<span class="genericon genericon-play"></span>
							</div><!-- .thumbnail-wrap -->
						</a>
						
						<?php } ?>

						<div class="entry-overview">

						<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						
						<div class="entry-meta">

							<span class="entry-views">
								<?php echo fastvideo_get_post_views(get_the_ID()); ?>
							</span><!-- .entry-views -->

						<span class="entry-date">
							<?php 
								if (get_theme_mod('date-format', 'choice-1') == 'choice-1') {
									echo human_time_diff(get_the_time('U'), current_time('timestamp')) . __(' ago', 'fastvideo');
								} else {
									echo get_the_date();
								}
							?>
						</span><!-- .entry-date -->
						
						</div><!-- .entry-meta -->	

						</div><!-- .entry-overview -->

					</div><!-- .hentry -->

				<?php
				
				$i++;

				endwhile;

				else :

					get_template_part( 'template-parts/content', 'none' );

				?>

			<?php endif; ?>

			</div><!-- .content-block -->

		</div><!-- #main -->
		<?php

			echo '<div class="clear"></div>';

			global $wp_version;

			if ( $wp_version >= 4.1 ) :

				the_posts_pagination( array( 'prev_text' => _x( 'Previous', 'previous post', 'fastvideo' ) ) );
			
			endif;

		?>		
	</div><!-- #primary -->

<?php get_footer(); ?>
