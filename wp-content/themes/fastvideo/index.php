<?php get_header(); ?>

	<?php
	// Display the featured content block if featured post exists
	$args = array(
	'post_type'      => 'post',
	//'orderby'        => 'date',
	//'order'          => 'DESC',
	//'posts_per_page' => 1,
    'meta_query' => array(
        array(
            'key'   => 'is_featured',
            'value' => 'true'
        	)
    	)			
	);

	// The Query
	$the_query = new WP_Query( $args );

	?>

	<?php

	if( ($the_query->have_posts()) && (get_theme_mod('featured-on', true)) ) {

	?>

	<div id="featured-content" class="clear">

		<?php

		$args = array(
		'post_type'      => 'post',
		//'orderby'        => 'date',
		//'order'          => 'DESC',
		'posts_per_page' => '3',
	    'meta_query' => array(
	        array(
	            'key'   => 'is_featured',
	            'value' => 'true'
	        	)
	    	)			
		);

		// The Query
		$the_query = new WP_Query( $args );

		// The Loop
		while ( $the_query->have_posts() ) : $the_query->the_post();
		?>	
			<div class="slide hentry">
				<a class="thumbnail-link" href="<?php the_permalink(); ?>">
					<div class="thumbnail-wrap">
						<?php 
							if ( has_post_thumbnail() ) {
								the_post_thumbnail( 'featured-thumb' ); 
							}
        				?>
					</div>
					<div class="overlay"></div>						
				</a>
				<div class="entry-info">			
					<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<div class="entry-meta">
						<span class="entry-category">
							<?php
								$category = get_the_category();
								if ($category) {
								  echo '<a href="' . get_category_link( $category[0]->term_id ) . '" title="' . sprintf( __( "View all posts in %s", 'fastvideo' ), $category[0]->name ) . '" ' . '>' . $category[0]->name.'</a> ';
								}
							?>
						</span>
						<span class="entry-views"> <?php echo fastvideo_get_post_views(get_the_ID()); ?></span>
						<span class="entry-date">
							<?php 
								if (get_theme_mod('date-format', 'choice-1') == 'choice-1') {
									echo human_time_diff(get_the_time('U'), current_time('timestamp')) . __(' ago', 'fastvideo');
								} else {
									echo get_the_date();
								}
							?>
						</span>
					</div>	
					<div class="watch-now">
						<a href="<?php the_permalink(); ?>"><span class="genericon genericon-play"></span><?php echo esc_html('Assistir', 'fastvideo'); ?></a>
					</div>
				</div><!-- .entry-info -->
			</div><!-- .slide -->
		<?php   
			endwhile;
			wp_reset_postdata();
		?>		

	</div><!-- #featured-content -->

	<?php 
		} 
		wp_reset_postdata();
	?>


	<?php if ( is_active_sidebar( 'homepage' ) ) : ?>
	
	<div class="recent-content">

		<?php dynamic_sidebar( 'homepage' ); ?>

		<?php if(get_theme_mod('home-button-on', true)) : ?>

			<div class="home-more">
				<a href="<?php echo get_theme_mod('home-button-url', home_url().'/latest'); ?>" class="btn"><?php echo get_theme_mod('home-button-text', __('Browse our latest videos', 'fastvideo')); ?></a>
			</div>

		<?php endif; ?>
	</div>

	<?php else : ?>

		<div class="home-content-notice">
			<p><?php echo __('There is no content on homepage', 'fastvideo'); ?></p>
			<p><?php echo __('Please put the <strong>Home Posts Block</strong> widget to the <strong>Home Content Area</strong>', 'fastvideo'); ?> (<a href="<?php echo get_template_directory_uri(); ?>/assets/img/how-to-home-widgets.png" target="_blank"><?php echo __('how to', 'fastvideo'); ?></a>)</p>
			<div class="home-more">
				<a class="btn" href="<?php echo home_url(); ?>/wp-admin/widgets.php"><?php echo __('Okay, I\'m doing now', 'fastvideo'); ?></a>
			</div>
		</div>

	<?php endif; ?>

<?php get_footer(); ?>
