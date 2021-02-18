<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package fastvideo
 */	

	//fastvideo_detect_embed();
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
		if ( is_single() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) : ?>

		<div class="entry-meta clear">

			<span class="post-author">
				<strong><?php echo the_author_posts_link(); ?></strong>
				<?php echo get_the_date(); ?>					
			</span><!-- .post-author -->

			<span class="post-comment">
				<a href="<?php echo get_comments_link( $post->ID ); ?>"><strong><?php comments_number( '0', '1', '%' ); ?></strong><?php echo __( 'Comments', 'fastvideo'); ?></a>
			</span><!-- .post-comment -->

			<span class="post-view">
				<?php echo fastvideo_get_post_views(get_the_ID()); ?>
			</span><!-- .post-view -->

			<span class="entry-share">
				<a class="icon-facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode( get_permalink( get_the_ID() ) ); ?>" title="<?php echo __('Share on Facebook', 'fastvideo'); ?>" target="_blank"><span class="genericon genericon-facebook-alt"></span></a>
				<a class="icon-twitter" href="https://twitter.com/intent/tweet?text=<?php echo urlencode( esc_attr( get_the_title( get_the_ID() ) ) ); ?>&amp;url=<?php echo urlencode( get_permalink( get_the_ID() ) ); ?>"  title="<?php echo __('Share on Twitter', 'fastvideo'); ?>" target="_blank"><span class="genericon genericon-twitter"></span></a>
				<a class="icon-pinterest" href="https://pinterest.com/pin/create/button/?url=<?php echo urlencode( get_permalink( get_the_ID() ) ); ?>&amp;media=<?php echo urlencode( wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) ) ); ?>" title="<?php echo __('Share on Pinterest', 'fastvideo'); ?>" target="_blank"><span class="genericon genericon-pinterest"></span></a>
				<a class="icon-google-plus" href="https://plus.google.com/share?url=<?php echo urlencode( get_permalink( get_the_ID() ) ); ?>" title="<?php echo __('Share on Google+', 'fastvideo'); ?>" target="_blank"><span class="genericon genericon-googleplus-alt"></span></a>
			</span><!-- .entry-share -->

		</div><!-- .entry-meta -->

		<?php
		endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
			the_content( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'fastvideo' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'fastvideo' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<div class="entry-tags">
		<?php if (has_category()) { ?><span><strong><?php echo __('Categories:', 'fastvideo'); ?></strong> <?php the_category(' '); ?></span><?php } ?>

		<?php if (has_tag()) { ?><span><strong><?php echo __('Tags:', 'fastvideo'); ?></strong> <?php the_tags('', ''); ?></span><?php } ?>
			
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
	</div><!-- .entry-tags -->

</article><!-- #post-## -->