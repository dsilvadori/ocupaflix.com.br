<?php
/*
 * Template Name: All Posts
 *
 * The template for displaying all posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package fastvideo
 */

get_header(); ?>

	<div id="primary" class="content-area layout-1c clear">

		<?php dynamic_sidebar( 'header-ad' ); ?>

		<div id="main" class="site-main clear">

			<div class="section-header inner-wrap">
				
				<h1>
					<?php
						esc_html_e('All Latest Videos', 'fastvideo');
					?>					
				</h1>
					
			</div><!-- .section-header -->

			<img src="<?php echo get_template_directory_uri();?>/assets/img/ajax-loader.gif" class="ajax-loader" alt="Loading..."/>

			<div class="content-block clear">

				<?php

					$temp = $wp_query;
					$wp_query= null;
					$wp_query = new WP_Query();
					$wp_query->query('paged='.$paged);

					if ( have_posts() ) :

					$i = 1;

					while ($wp_query->have_posts()) : $wp_query->the_post();

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

			global $wp_version;

			if ( $wp_version >= 4.1 ) :

				the_posts_pagination( array( 'prev_text' => _x( 'Previous', 'previous post', 'fastvideo' ) ) );
			
			endif;

		?>

		<?php $wp_query = null; $wp_query = $temp;?>

	</div><!-- #primary -->

<?php get_footer(); ?>
